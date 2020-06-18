<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    protected $fillable = [
    'filename','user_id'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function fileuploads()
    {
    	return $this->belongsTo('App\FileUpload');
    }
}
