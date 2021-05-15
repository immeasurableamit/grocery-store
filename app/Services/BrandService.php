<?php

namespace App\Services;

use File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Requests\BrandCreateRequest;
use App\Models\Brand;
use App\Repository\BrandRepositoryInterface;

class BrandService
{
    private $brandRepository;

    /**
     * BrandRepositoryInterface constructor.
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param BrandCreateRequest $request
     * @return mixed
     */
    public function createBrand(BrandCreateRequest $request)
    {
        $payload = $request->post();
        $payload['created_by'] = auth()->user()->id;

        $payload['slug'] = preg_replace('/[^a-z0-9\-]/', '', str_replace(' ', '-', $request->name));

        $brand = $this->brandRepository->create($payload);

        $this->handleModulePictureCrop($brand);

        return $brand;
    }

    /**
     * @param Brand $brand
     */
    public function handleModulePictureCrop(Brand $brand)
    {

        if (request()->hasFile('logo')) {
            $destination = BRAND_LOGO_IMAGE_PATH . '/' . $brand->id;


            if (!File::isDirectory($destination)) {
                File::makeDirectory($destination, 0777, true, true);
            }

            $file = request()->logo;
            $fileName = Str::random(10) . '.' . $file->extension();

            Image::make($file)->fit(200, 200)->save($destination . '/' . $fileName);

            $brand->logo = $fileName;
            $brand->save();
        }
    }

     /**
     * @param Brand $brand
     */
    public function updateBrand(Brand $brand)
    {
        $brand = $this->brandRepository->find($brand->id);

        $payload = request()->all();

        $payload['updated_by'] = auth()->user()->id;

        $this->brandRepository->update($payload, $brand->id);

        $this->handleModulePictureCrop($brand);
    }

    public function get()
    {
        return $this->brandRepository->all();
    }

    /**
     * Get post by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->brandRepository->getById($id);
    }

     /**
     * @param Brand $brand
     * @return mixed
     */
    public function deleteBrand(Brand $brand)
    {
        $this->brandRepository->update([
            'deleted_by' => auth()->user()->id
        ], $brand->id);


        $destination = BRAND_LOGO_IMAGE_PATH . '/' . $brand->id . '/' . $brand->banner;
        if (is_dir($destination)) {
            File::delete($destination);
        }

        $this->brandRepository->delete($brand->id);
    }
}
