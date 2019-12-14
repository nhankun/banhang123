<?php

namespace App\Services\Uploads;

use Image;
use File;

trait handleUploadImage
{
    public function handleUploadImage($image,$first_name,$dir,$width,$height)
    {
        if (!is_null($image)) {
            $extension = $image->getClientOriginalExtension();
            $file_name = $first_name . time() . '.' . $extension;
            $file_link = $dir . $file_name;
            if (!File::exists($dir)) {
                mkdir($dir, 666, true);
            }
            Image::make($image->getRealPath())->resize($width, $height)->save($dir . $file_name);
            return $file_link;
        }
    }

    public function handleUploadImages($image,$first_name,$dir,$width,$height,$i)
    {
        if (!is_null($image)) {
            $extension = $image->getClientOriginalExtension();
            $file_name = $first_name . time() . $i . '.' . $extension;
            $file_link = $dir . $file_name;
            if (!File::exists($dir)) {
                mkdir($dir, 666, true);
            }
            Image::make($image->getRealPath())->resize($width, $height)->save($dir . $file_name);
            return $file_link;
        }
    }
}
