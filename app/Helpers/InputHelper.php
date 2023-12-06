<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use File;

class InputHelper
{

     static public function upload($file, $path)
     {
          $file_name = time() . '.' . $file->getClientOriginalExtension();
          $destination_path = public_path($path);
          $file->move($destination_path, $file_name);

          return $path . $file_name;
     }
     static public function uploadWithCrop($file, $path, $width, $height, $x = null, $y = null)
     {
          $file_name = time() . '.' . $file->getClientOriginalExtension();
          $destination_path = public_path($path);
          $image = Image::make($file->path());
          $image->crop($width, $height, $x, $y)->save($destination_path . $file_name);

          return $path . $file_name;
     }

     public static function delete($path)
     {
          File::delete($path);
     }
}
