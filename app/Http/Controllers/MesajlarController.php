<?php

namespace App\Http\Controllers;

use App\Mesajlar;
use App\Proje;
use App\User;
use Auth;
use Illuminate\Http\Request;

class MesajlarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $email=Auth::user()->email;

        $gelenmesaj = Mesajlar::where('kullanici_adi',$email)->where('gonderen_kisi', '<>', $email)->get();

        $kullanicilar = User::all();

        $gidenmesaj = Mesajlar::where('gonderen_kisi',$email)->get();


        return compact('gelenmesaj','gidenmesaj','kullanicilar');
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
        $email=Auth::user()->email;


        $mesajlar = new Mesajlar;
        $kullanici_adi=$request->input('kullanici_adi');
        $gonderen_kisi=$request->input('gonderen_kisi');

        if($kullanici_adi==$email){
            $mesajlar->kullanici_adi = $request->input('gonderen_kisi');
        $mesajlar->gonderen_kisi = $email;
        $mesajlar->mesajdetayi = $request->input('mesajdetayi');
        $mesajlar->onemdurumu = $request->input('onemdurumu');
        $mesajlar->onaydurumu = '1';
    }else{
        $mesajlar->kullanici_adi = $request->input('kullanici_adi');
        $mesajlar->gonderen_kisi = $email;
        $mesajlar->mesajdetayi = $request->input('mesajdetayi');
        $mesajlar->onemdurumu = $request->input('onemdurumu');
        $mesajlar->onaydurumu = '1';
    }
        
        $mesajlar->save();

        return response()->json(['success' => $mesajlar->kullanici_adi.' kisiye mesaj gondermistir.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mesajlar  $mesajlar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $mesaj = Mesajlar::find($id);

        return $mesaj;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mesajlar  $mesajlar
     * @return \Illuminate\Http\Response
     */
    public function edit(Mesajlar $mesajlar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mesajlar  $mesajlar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mesajlar $mesajlar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mesajlar  $mesajlar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Mesajlar::find($id)->delete();
 
        return response()->json([
            'message' => 'Silinme Başarılı!'
        ], 200);
    }
}
