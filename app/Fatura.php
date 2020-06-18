<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    //
    //
    protected $table = 'faturas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proje_id', 'faturano', 'faturadetay','faturamail', 'faturatarih', 'faturatotal', 'faturavergi','faturaodeme','faturaadres','webadresi','telefon','il','ilce','ulke'
    ];

    
}
