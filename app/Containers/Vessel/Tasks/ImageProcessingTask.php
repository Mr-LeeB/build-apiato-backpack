<?php

namespace App\Containers\Vessel\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Http\UploadedFile;
use Image;

class ImageProcessingTask extends Task
{
  public function run(UploadedFile $data)
  {
    // Create a canvas and resize the image
    $canvas = Image::canvas(500, 500);
    $image = Image::make($data)->resize(500, 500, function ($constraint) {
      $constraint->aspectRatio();
    });

    // Insert the image into the canvas and encode it
    $canvas->insert($image, 'center')->encode('png', 100);

    return $canvas;
  }
}
