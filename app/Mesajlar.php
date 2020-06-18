<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesajlar extends Model
{
    //

    protected $fillable = ['kullanici_adi', 'gonderen_kisi', 'mesajdetayi','onemdurumu','onaydurumu'];
}
