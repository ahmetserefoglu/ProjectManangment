<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjeKisiler extends Model
{
    //
    protected $table='proje_kisilers';

    protected $fillable = ['id','proje_id', 'user_id', 'isim','userid','durum'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function proje()
    {
    	return $this->belongsTo('App\Proje');
    }
}
