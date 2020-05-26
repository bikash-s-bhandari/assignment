<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected $data = [];
    protected $default_pagination_limit = 20;
    protected $upload_path = 'uploads/';
    public function __construct()
    {

    }

    /*resize the image */

    public function resizeImage($x = 508, $y = 600, $image_name, $original_path, $modified_path = 'modified')
    {

        return $resized_image = Image::make($this->upload_path . $original_path . '/' . $image_name)
            ->resize($x, $y, function ($constraint) {
                // $constraint->aspectRatio();

            })->save($this->upload_path . $modified_path . '/' . $image_name, 50);

    }

    //Crop and resize combined
    public function fitImage($x = 508, $y = 600, $image_name, $original_path, $modified_path = 'modified')
    {

        return $fit_image = Image::make($this->upload_path . $original_path . '/' . $image_name)
            ->fit($x, $y, function ($constraint) {
                $constraint->upsize();

            })->save($this->upload_path . $modified_path . '/' . $image_name, 50);

    }

    //Crop image
    public function cropImage($x = 508, $y = 600, $image_name, $original_path, $modified_path = 'modified')
    {

        return $croped_image = Image::make($this->upload_path . $original_path . '/' . $image_name)
            ->crop($x, $y, 25, 25)->save($this->upload_path . $modified_path . '/' . $image_name, 50);

    }
}
