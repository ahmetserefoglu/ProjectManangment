<?php

namespace App\Http\Controllers;

use App\Firmalar;
use App\User;
use Illuminate\Http\Request;
use App\Role;
use Hash;
use DB;

class FirmalarController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sehirler($id)
    {
        //

        $firmalar = Firmalar::all();
        $sehirler = DB::table('city')->where('CountryName','=',$id)->get();
        $ulkeler = DB::table('country')->get();
        return view('firmalar.index',['page_title'=>'Firmalar','firmalar'=>$firmalar,'sehirler'=>$sehirler,'ilceler'=>$ilceler,'ulkeler'=>$ulkeler]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $firmalar = Firmalar::all();
        $sehirler = DB::table('city')->get();
        $ilceler = DB::table('district')->get();
        $ulkeler = DB::table('country')->get();
        return view('firmalar.index',['page_title'=>'Firmalar','firmalar'=>$firmalar,'sehirler'=>$sehirler,'ilceler'=>$ilceler,'ulkeler'=>$ulkeler]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sehirler = DB::table('city')->get();
        $ilceler = DB::table('district')->get();
        $ulkeler = DB::table('country')->get();
        return view('firmalar.create',['page_title'=>'Firmalar','sehirler'=>$sehirler,'ilceler'=>$ilceler,'ulkeler'=>$ulkeler]);
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
        $this->validate($request, [
            'FirmaAdi' => 'required',
            'YetkiliAdi' => 'required',
            'YetkiliSoyadi' => 'required',
            'email' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);


        $gallery = new Firmalar;

        $gallery->FirmaAdi=$request->input('FirmaAdi');
        $gallery->YetkiliAdi=$request->input('YetkiliAdi');
        $gallery->YetkiliSoyadi=$request->input('YetkiliSoyadi');
        $gallery->email=$request->input('email');
        $gallery->address=$request->input('address');
        $gallery->password=$request->input('password');
        $gallery->il=$request->input('il');
        $gallery->ilce=$request->input('ilce');
        $gallery->ulke=$request->input('ulke');
        $gallery->telefon=$request->input('telefon');
        $gallery->webadresi=$request->input('webadresi');
        $gallery->save();

        $input = $request->only('name', 'email', 'password');
        $input['password'] = Hash::make($input['password']);
        $input['api_token']=str_random(60);
        $input['rolename']='Müşteri';
        $input['name']=$request->input('FirmaAdi');

        $user = User::create($input);

        $roles=DB::table('roles')->where('rolename','=','Müşteri')->get();
        
        DB::table('role_users')->insert(
            ['user_id' => $user->id, 'role_id' => $roles[0]->roleid]
        );

        $firmalar = Firmalar::all();

        return view('firmalar.index', ['success'=>'Firma Kaydedildi','firmalar' => $firmalar]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Firmalar  $firmalar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $firmalar = Firmalar::findOrFail($id);
        $sehirler = DB::table('city')->get();
        $ilceler = DB::table('district')->get();
        $ulkeler = DB::table('country')->get();
        return view('firmalar.show',['page_title'=>'Firmalar','firmalar'=>$firmalar,'sehirler'=>$sehirler,'ilceler'=>$ilceler,'ulkeler'=>$ulkeler]);
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
        $firmalar = Firmalar::findOrFail($id);
        $sehirler = DB::table('city')->get();
        $ilceler = DB::table('district')->get();
        $ulkeler = DB::table('country')->get();
        if ($firmalar == null || count($firmalar) == 0) {
            return redirect()->intended('/firmalar');
        }

        return view('firmalar.edit', ['page_title'=>'Duzenle','firmalar' => $firmalar,'sehirler'=>$sehirler,'ilceler'=>$ilceler,'ulkeler'=>$ulkeler]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Firmalar  $firmalar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $department = Firmalar::findOrFail($id);
        //$this->validateInput($request);
        $input = [
            'FirmaAdi' => $request['FirmaAdi'],
            'YetkiliAdi' => $request['YetkiliAdi'],
            'YetkiliSoyadi' => $request['YetkiliSoyadi'],
            'email' => $request['email'],
            'password'=>$request['password'],
            'address' =>$request['address'],
            'il' => $request['il'],
            'ilce' => $request['ilce'],
            'ulke'=>$request['ulke'],
            'webadresi' =>$request['webadresi'],
            'telefon'=>$request['telefon']
        ];
        Firmalar::where('id', $id)
            ->update($input);
        
        $firmalar = Firmalar::all();

        return redirect()->intended('firmalar')->with('firmalar', $firmalar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Firmalar  $firmalar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Firmalar::where('id', $id)->delete();
         return redirect()->intended('firmalar');
    }
}
