<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function get ($imagename){
        $storagePath = storage_path('/product_images/' . $imagename);

        return Image::make($storagePath)->response();
    }
}
