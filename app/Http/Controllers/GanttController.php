<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gorev;
use App\Link;

class GanttController extends Controller
{
    //
    public function gantt()
    {
    	return view('gantt',["page_title"=>"Gorevler"]);
    }

    public function get()
     {
        $gorevs = new Gorev();
        $links = new Link();
 
        return response()->json([

            "data" => $gorevs->orderBy('sortorder')->get(),
            "links" => $links->all()
        ]);
    }
}
