<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Livewire\Posts;
use App\Http\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AboutUsComponent;
use App\Http\Livewire\ContactUsComponent;
use App\Http\Livewire\ReturnPolicyComponent;
use App\Http\Livewire\PrivacyPolicyComponent;
use App\Http\Livewire\UserDashboardComponent;
use App\Http\Livewire\TermsConditionsComponent;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\AdminDashboardComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', HomeComponent::class);

Route::get('/about-us', AboutUsComponent::class);

Route::get('/privacy-policy', PrivacyPolicyComponent::class);

Route::get('/terms-conditions', TermsConditionsComponent::class);

Route::get('/return-policy', ReturnPolicyComponent::class);

Route::get('/contact-us', ContactUsComponent::class);





// Dashboard particular users or clientes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});

// Dashboard particular admin
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    Route::resource('admin/categories', CategoryController::class);

    Route::resource('admin/brands', BrandController::class);

    Route::resource('admin/products', ProductController::class);
});
