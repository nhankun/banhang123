<?php

namespace App\Repositories\Back\Products;

use App\Models\Image;
use App\Models\Product;
use App\Services\Uploads\handleUploadImage;

class ImageRepository
{
    use handleUploadImage;

    CONST WIDTH_IMG = 192;
    CONST HEIGHT_IMG = 192;
    CONST FIRST_NAME = 'product';

    public function createImages($files, $product)
    {
        $dir = 'uploads/products/' . $product->id . '/general/';
        $fileLinks = $this->handleUploadImages($files, self::FIRST_NAME, $dir, self::WIDTH_IMG, self::HEIGHT_IMG);
        if ($fileLinks != null){
            foreach ($fileLinks as $fileLink)
            {
                $image = Image::create([
                    'product_id' => $product->id,
                    'link' => $fileLink,
                    'title' => $product->name,
                ]);
            }
        }
    }

    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function getImageById($id)
    {
        return Image::findOrFail($id);
    }

    public function getImageByProductId($product_id)
    {
        return Image::where('product_id', $product_id)->get();
    }

    public function delete($id)
    {
        $image = self::getImageById($id);
        @unlink($image->link);
        return $image->forceDelete();
    }
}
