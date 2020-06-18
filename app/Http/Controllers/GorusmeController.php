<?php

namespace App\Http\Controllers;

use App\Gorusme;
use App\Firmalar;
use App\User;
use Illuminate\Http\Request;
use App\Role;
use Hash;
use DB;
use App\Department;
use Auth;

class GorusmeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gorusmeler = Gorusme::all();

        return view('gorusmeler.index',['page_title'=>'Görüşmeler','gorusmeler'=>$gorusmeler]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kullanicilar=User::all();
        $firmalar=Firmalar::all();
        $departmentlar = Department::all();
        return view('gorusmeler.create',['page_title'=>'Görüşmeler','kullanicilar'=>$kullanicilar,'firmalar'=>$firmalar,'departmentlar' => $departmentlar]);
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
        /*$this->validate($request, [
            'GorusmeKonusu' => 'required',
            'Tarih' => 'required',
            'Yontemi' => 'required',
            'GorusmeDe' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);*/

        $departments = Department::where('id',$request->input('department_id'))->get();

        $gorusme = new Gorusme;

        $gorusme->user_id = Auth::user()->id;
        $gorusme->GorusenKisi = $request->input('GorusenKisi');
        $gorusme->GorusmeKonusu=$request->input('GorusmeKonusu');
        $gorusme->Tarih=$request->input('Tarih');
        $gorusme->Yontemi=$departments[0]->name;
        $gorusme->department_id=$request->input('department_id');
        $gorusme->GorusmeDetayi=$request->input('GorusmeDetayi');
        $gorusme->OnemDerecesi=$request->input('OnemDerecesi');
        $gorusme->firma_id=$request->input('firma_id');
        $gorusme->save();


        $gorusmeler = Gorusme::all();

        return view('gorusmeler.index', ['success'=>'Gorusme Kaydedildi','gorusmeler' => $gorusmeler]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gorusme  $gorusme
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $gorusme = Gorusme::findOrFail($id);

        return view('gorusmeler.show')->with('gorusme',$gorusme);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gorusme  $gorusme
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $gorusmeler = Gorusme::findOrFail($id);
        $kullanicilar=User::all();
        $firmalar=Firmalar::all();
        $departmentlar = Department::all();
        if ($gorusmeler == null || count($gorusmeler) == 0) {
            return redirect()->intended('/gorusmeler');
        }

        return view('gorusmeler.edit', ['page_title'=>'Duzenle','gorusmeler' => $gorusmeler,'kullanicilar'=>$kullanicilar,'firmalar'=>$firmalar,'departmentlar' => $departmentlar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gorusme  $gorusme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        //
        $departments = Department::where('id',$request->input('department_id'))->get();
        $gorusmeler = Gorusme::findOrFail($id);
        //$this->validateInput($request);
        $input = [
            'user_id' => Auth::user()->id,
            'GorusenKisi' => $request['GorusenKisi'],
            'GorusmeKonusu' => $request['GorusmeKonusu'],
            'Tarih' => $request['Tarih'],
            'department_id'=>$request->input('department_id'),
            'Yontemi' =>$departments[0]->name,
            'GorusmeDetayi' => $request['GorusmeDetayi'],
            'OnemDerecesi' => $request['OnemDerecesi'],
            'firma_id' => $request['firma_id']
        ];
        Gorusme::where('id', $id)
            ->update($input);
        
        $gorusmeler = Gorusme::all();

        return redirect()->intended('gorusmeler')->with('success','Gorusme Kaydedildi','gorusmeler' ,$gorusmeler);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gorusme  $gorusme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Gorusme::where('id', $id)->delete();
         return redirect()->intended('gorusmeler');
    }
}
