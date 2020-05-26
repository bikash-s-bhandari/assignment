<?php

namespace App;

class ProductImage extends BaseModel
{
    protected $table = 'product_images';
    protected $guarded = ['id'];

    public function getImage()
    {
        return $this->image != null
        ? asset($this->upload_path . 'products/' . $this->image)
        : asset($this->upload_path . "no-image.jpg");
    }
}
