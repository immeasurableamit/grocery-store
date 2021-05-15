<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Services\BrandService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\BrandCreateRequest;

class BrandController extends Controller
{
    protected $brandService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
        $this->middleware('auth');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brandService->get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       return view('admin.brand.create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BrandCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandCreateRequest $request)
    {
        $this->brandService->createBrand($request);
            toastr()->success('Brand added');
            return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

     /**
     * Update the specified resource in storage.
     * @param BrandCreateRequest $request
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function update(BrandCreateRequest $request, Brand $brand)
    {
        $this->brandService->updateBrand($brand);

        return Redirect::route('brands.edit', ['brand' => $brand->id])
            ->with('flash_notification.message', 'Brand has been updated.')
            ->with('flash_notification.level', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $this->brandService->deleteBrand($brand);

        return Redirect::route('brands.index')
            ->with('flash_notification.message', 'Brand has been deleted.')
            ->with('flash_notification.level', 'success');
    }
}
