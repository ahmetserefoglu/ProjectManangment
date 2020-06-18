<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gorev extends Model
{
    //

    protected $appends = ["open"];
 
    public function getOpenAttribute(){
        return true;
    }
}
