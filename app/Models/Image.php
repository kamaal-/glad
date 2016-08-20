<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Collage as Collage;

class Image extends Model
{

    public static $rules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ];
    public static $messages = [
        'file.mimes' => 'Uploaded file is not in image format',
        'file.required' => 'Image is required'
    ];
    /**
     * Get the Collage that owns this Image.
     */
    public function collage()
    {
        return $this->belongsTo('Collage');
    }
}
