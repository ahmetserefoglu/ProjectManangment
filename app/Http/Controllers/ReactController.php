<?php

namespace App\Http\Controllers;

use App\ReactUser;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = ReactUser::all();
        
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $item = new ReactUser([
            
          'name' => $request->get('name'),
          'meslek' => $request->get('meslek'),
          'gorevi' => $request->get('gorevi'),
          'maasi' => $request->get('maasi')
        ]);
        $item->save();
        return response()->json('Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = ReactUser::find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = ReactUser::find($id);
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
        $item = ReactUser::find($id);
        $item->name = $request->get('name');
        $item->meslek = $request->get('meslek');
        $item->gorevi = $request->get('gorevi');
        $item->maasi = $request->get('maasi');
        $item->save();

        return response()->json('Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = ReactUser::find($id);
        $item->delete();

        return response()->json('Successfully Deleted');
    }
}
