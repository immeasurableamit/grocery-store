<?php

namespace App\Services;

use File;
use Intervention\Image\Facades\Image;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryCreateRequest;
use App\Repository\CategoryRepositoryInterface;

class CategoryService
{
    private $categoryRepository;

    /**
     * CategoryRepositoryInterface constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CategoryCreateRequest $request
     * @return mixed
     */
    public function createCategory(CategoryCreateRequest $request)
    {
        $payload = $request->post();
        $payload['created_by'] = auth()->user()->id;

        $payload['slug'] = preg_replace('/[^a-z0-9\-]/', '', str_replace(' ', '-', $request->name));

        if ($request->parent_id != "0") {
            $payload['parent_id'] = $request->parent_id;

            $parent = Category::find($request->parent_id);
            $payload['level'] = $parent->level + 1;
        }

        if ($request->order_level != null) {
            $payload['order_level'] = $request->order_level;
        }


        $category = $this->categoryRepository->create($payload);

        $this->handleModulePictureCrop($category);

        return $category;
    }

    /**
     * @param Category $category
     */
    public function handleModulePictureCrop(Category $category)
    {

        if (request()->hasFile('banner')) {
            $destination = CATEGORY_BANNER_IMAGE_PATH . '/' . $category->id;


            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0777, true, true);
            }

            $file = request()->banner;
            $fileName = Str::random(10) . '.' . $file->extension();

            Image::make($file)->fit(200, 200)->save($destination . '/' . $fileName);

            $category->banner = $fileName;
            $category->save();
        }

        if (request()->hasFile('icon')) {
            $destination = CATEGORY_ICON_IMAGE_PATH . '/' . $category->id;

            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0777, true, true);
            }

            $file = request()->icon;
            $fileName = Str::random(10) . '.' . $file->extension();

            Image::make($file)->fit(32, 32)->save($destination . '/' . $fileName);

            $category->icon = $fileName;
            $category->save();
        }
    }

     /**
     * @param Category $category
     */
    public function updateCategory(Category $category)
    {
        $category = $this->categoryRepository->find($category->id);

        $payload = request()->all();

        $payload['updated_by'] = auth()->user()->id;

        $this->categoryRepository->update($payload, $category->id);

        $this->handleModulePictureCrop($category);
    }

    public function get()
    {
        return $this->categoryRepository->all();
    }

    /**
     * Get post by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->categoryRepository->getById($id);
    }

     /**
     * @param Category $category
     * @return mixed
     */
    public function deleteCategory(Category $category)
    {
        $this->categoryRepository->update([
            'deleted_by' => auth()->user()->id
        ], $category->id);


        $destination = CATEGORY_BANNER_IMAGE_PATH . '/' . $category->id . '/' . $category->banner;
        if (is_dir($destination)) {
            File::delete($destination);
        }

        $destination = CATEGORY_ICON_IMAGE_PATH . '/' . $category->id . '/' . $category->icon;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $this->categoryRepository->delete($category->id);
    }
}
