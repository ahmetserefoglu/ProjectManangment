<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjeDosyalari extends Model
{
    //
    protected  $table='proje_dosyalari';

    protected $fillable = ['projedetay_id', 'filename', 'file_path','file_size','proje_id','user_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function projedetay()
    {
    	return $this->belongsTo('App\Projedetay');
    }
}
