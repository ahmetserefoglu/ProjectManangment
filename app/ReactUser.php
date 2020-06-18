<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReactUser extends Model
{
    //
    protected $table='reactuser';

    public $timestamps =false;


    protected $fillable = ['id','name','meslek','gorevi','maasi'];
}
