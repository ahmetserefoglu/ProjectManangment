<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gorev;

class GorevController extends Controller
{
    //
    public function index()
    {
        $gorevler = Gorev::all();

        return view('gorevler.index',['page_title'=>'Gorevler','gorevler'=>$gorevler]);
    }

    public function create(Request $request){
 
        return view('gorevler.create');
    }

    public function store(Request $request){
 
        $task = new Gorev();
 
        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
        $task->sortorder = Gorev::max("sortorder") + 1;
 
        $task->save();
 	

 		

        return response()->json([
            "action"=> "inserted",
            "tid" => $task->id
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Firmalar  $firmalar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $gorev = Gorev::findOrFail($id);

        return view('gorevler.edit', ['page_title'=>'Duzenle','gorev' => $gorev]);
    }

    public function update($id, Request $request){
        $task = Gorev::find($id);
 
        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;
 
        $task->save();
 	
 	if($request->has("target")){
	        $this->updateOrder($id, $request->target);
	    }

        return response()->json([
            "action"=> "updated"
        ]);
    }
 	
 	private function updateOrder($taskId, $target){
    $nextTask = false;
    $targetId = $target;
 
    if(strpos($target, "next:") === 0){
        $targetId = substr($target, strlen("next:"));
        $nextTask = true;
    }
 
    if($targetId == "null")
        return;
 
    $targetOrder = Gorev::find($targetId)->sortorder;
    if($nextTask)
        $targetOrder++;
 
    Gorev::where("sortorder", ">=", $targetOrder)->increment("sortorder");
 
    $updatedTask = Gorev::find($taskId);
    $updatedTask->sortorder = $targetOrder;
    $updatedTask->save();
}

    public function destroy($id){
        $task = Gorev::find($id);
        $task->delete();
 
        return response()->json([
            "action"=> "deleted"
        ]);
    }
}
