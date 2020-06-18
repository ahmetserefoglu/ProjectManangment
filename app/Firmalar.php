<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firmalar extends Model
{
    //
    protected $table = 'firmalars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FirmaAdi', 'YetkiliAdi', 'YetkiliSoyadi', 'email', 'address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
