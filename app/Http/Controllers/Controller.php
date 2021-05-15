<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

define('CATEGORY_BANNER_IMAGE_PATH', public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'categories/banner');
define('CATEGORY_BANNER_IMAGE_URL', url('/files/categories/banner'));

define('CATEGORY_ICON_IMAGE_PATH', public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'categories/icon');
define('CATEGORY_ICON_IMAGE_URL', url('/files/categories/icon'));


define('BRAND_LOGO_IMAGE_PATH', public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'brands');
define('BRAND_LOGO_IMAGE_URL', url('/files/brands'));


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
