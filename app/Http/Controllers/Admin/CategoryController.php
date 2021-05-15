<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoryCreateRequest;

class CategoryController extends Controller
{
    protected $categoryService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $categories = $this->categoryService->get();
        $categories = $this->categoryService->get();

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        try {
            $this->categoryService->createCategory($request);
            toastr()->success('Category added');
            return redirect()->route('categories.index');
        } catch (Exception $e) {
            return $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->categoryService->getById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = $this->categoryService->get();

        return view('admin.category.edit', compact('category','categories'));
    }

      /**
     * Update the specified resource in storage.
     * @param CategoryCreateRequest $request
     * @param Category $Category
     * @return RedirectResponse
     */
    public function update(CategoryCreateRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category);

        return Redirect::route('categories.edit', ['category' => $category->id])
            ->with('flash_notification.message', 'Module has been updated.')
            ->with('flash_notification.level', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);

        return Redirect::route('categories.index')
            ->with('flash_notification.message', 'Category has been deleted.')
            ->with('flash_notification.level', 'success');
    }
}
