<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repository\ImageRepository as ImageRepository;
use Illuminate\Support\Facades\Input;
use App\Models\Collage;
use App\Models\Image;
class ImageController extends Controller
{
  protected $image;

  public function __construct(ImageRepository $imageRepository)
  {
      $this->image = $imageRepository;
  }

  public function getUpload()
  {
      return view('pages.upload');
  }

  public function postUpload()
  {
      $photo = Input::all();
      $response = $this->image->upload($photo);
      return $response;
  }

  public function deleteUpload()
  {
      $filename = Input::get('id');

      if(!$filename)
      {
        return 0;
      }
      $response = $this->image->delete( $filename );
      return $response;
  }

  public function getOne(Request $request)
  {
    $collage = Collage::find($request->id);
    return 2;
  }
}
