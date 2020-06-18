<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileUpload extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
      'title',
      'proje_id',
      'durumu',
      'overview'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function uploads()
    {
    	return $this->hasMany('App\Upload');
    }

}
