<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projedetay extends Model
{
    //
    protected $table='projedetay';

    protected $fillable = ['id','proje_detay_baslik', 'proje_detay', 'durumu','proje_id','user_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function projedosyalari()
    {
    	return $this->hasMany('App\ProjeDosyalari');
    }

    public function proje()
    {
    	return $this->belongsTo('App\Proje');
    }
}
