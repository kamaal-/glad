<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collage as Collage;
use App\Models\Image as Image;

use App\Http\Requests;
use App\User;
class CollageController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * list all collages of this user.
     *
     * @return Response
     */
    public function all()
    {
      return Collage::with('images')->where('state', 'published')->get();
    }

    /**
     * show single collage.
     *
     * @return Response
     */
    public function show(Request $request)
    {
        $collage = Collage::find($request->id);
        //dd(auth()->guest());
        return view('collage.single', ['collage' => $collage]);
    }

    public function create(Request $request)
    {
        $user = User::find($request['user']['sub']);
        $collage = new Collage;
        $collage->name = 'Collage';
        $collage->state = 'pending';
        $col = $user->collages()->save($collage);
        return $col;
    }

    public function update(Request $request)
    {
      $collage = Collage::find($request->id);
      $image = $collage->images()->first();
      if($image){
        $collage->thumbnail = $image->filename;
        $collage->state = 'published';
        $collage->save();
        return 1;
      }else{
        return 0;
      }
    }


}
