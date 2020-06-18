<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fatura;
use App\Firmalar;
use App\User;
use App\Proje;
use App\Role;
use Hash;
use DB;
use Auth;
use Mail;
use PDF;
use Dompdf\Dompdf;

class FaturaController extends Controller
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
    public function index()
    {
        //
        $faturalar = Fatura::all();
        $projeler = Proje::all();
        $sehirler = DB::table('city')->get();
        $ilceler = DB::table('district')->get();
        $ulkeler = DB::table('country')->get();
        return view('faturalar.index',['page_title'=>'Faturalar','faturalar'=>$faturalar,'projeler'=>$projeler,'sehirler'=>$sehirler,'ilceler'=>$ilceler,'ulkeler'=>$ulkeler]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $firmalar = Firmalar::all();
        $projeler = Proje::all();
        $sehirler = DB::table('city')->get();
        $ilceler = DB::table('district')->get();
        $ulkeler = DB::table('country')->get();
        return view('faturalar.create',['page_title'=>'Faturalar','firmalar'=>$firmalar,'projeler'=>$projeler,'sehirler'=>$sehirler,'ilceler'=>$ilceler,'ulkeler'=>$ulkeler]);
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
        $fatura = new Fatura;

        $fatura->faturano=$request->input('faturano');
        $fatura->faturamusteri=$request->input('faturamusteri');
        $fatura->faturadetay=$request->input('faturadetay');
        $fatura->faturatarih=$request->input('faturatarih');
        $fatura->faturatotal=$request->input('faturatotal');
        $fatura->faturavergi=$request->input('faturavergi');
        $fatura->faturaadres=$request->input('faturaadres');
        $fatura->faturaodeme=$request->input('faturaodeme');
        $fatura->proje_id=$request->input('proje_id');
        $fatura->il=$request->input('il');
        $fatura->ilce=$request->input('ilce');
        $fatura->ulke=$request->input('ulke');
        $fatura->telefon=$request->input('telefon');
        $fatura->webadresi=$request->input('webadresi');
        var_dump($fatura);

        $fatura->save();

        $faturalar = Fatura::all();

        return view('faturalar.index', ['success'=>'Fatura Kaydedildi','page_title'=>'Faturalar','faturalar' => $faturalar]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $fatura = Fatura::findOrFail($id);


        $projeler = DB::select("SELECT 
            DISTINCT p.*,SUM((((((pkisi.durum*p.Sure)/100)*pdetay.Durumu)))/p.Sure) as toplam 
            FROM projes p 
            Inner JOIN projedetay pdetay on p.id=pdetay.proje_id 
            Inner JOIN proje_kisilers pkisi on pkisi.proje_id=pdetay.proje_id and pdetay.user_id=pkisi.userid 
            WHERE p.id=1
            GROUP BY p.BaslangicTarihi,p.BitisTarihi,p.DosyaAdi,p.id,p.user_id,p.updated_at,p.created_at,p.Durumu,p.FirmaAdi,p.Icerik,p.Kisiler,p.ProjeAdi,p.Sure");
        

        return view('faturalar.show',['page_title'=>'Faturalar','fatura'=>$fatura,'projeler'=>$projeler[0]]);
    }


     /**
     * Display the specified resource.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
     public function send(Request $request,$id='')
     {
        //
         $request->merge([ 
            'select_all' => implode(',', (array) $request->get('select_all'))
        ]);

         $email='aserefoglu@durak.com.tr';
         $gonderen='aserefoglu@durak.com.tr';

         $checkbox=$request->input('select_all');
         $t=explode(',', $checkbox);
         if ($t>1) {
            foreach ($t as $key ) {
               
            }
        }

        $sonuc=array();
        $faturax = DB::select("SELECT * FROM faturas where id IN($checkbox) ");

        //Fatura::whereIn('id', [$checkbox])->get();

        
        $name=Auth::user()->name;
        $projeler = DB::select("SELECT 
            DISTINCT p.*,SUM((((((pkisi.durum*p.Sure)/100)*pdetay.Durumu)))/p.Sure) as toplam 
            FROM projes p 
            Inner JOIN projedetay pdetay on p.id=pdetay.proje_id 
            Inner JOIN proje_kisilers pkisi on pkisi.proje_id=pdetay.proje_id and pdetay.user_id=pkisi.userid 
            WHERE p.id=1
            GROUP BY p.BaslangicTarihi,p.BitisTarihi,p.DosyaAdi,p.id,p.user_id,p.updated_at,p.created_at,p.Durumu,p.FirmaAdi,p.Icerik,p.Kisiler,p.ProjeAdi,p.Sure");

         //$faturax=array("fatura"=>$faturax);

         $data=json_decode(json_encode($faturax), True); 
         /*foreach ($data as $value) {
              array_push($sonuc,$value);
         }*/

         $sonucx=array('data' => $faturax);


        //$x = $sonucx['data'];
        //$datax = array('name'=>'John Smith', 'date'=>'1/29/15');
        //$datay= array('data' => $datax);

        $pdf = PDF::loadView('show',$sonucx); 
        $pdf->setPaper('A4', 'landscape');
         //print_r($pdf);
        //exit;
             // $pdf->save(storage_path().'_filename.pdf');
          //$pdf->setPaper('A3', 'landscape');
          //return PDF::load($pdf, 'A4', 'landscape')
            //        ->output();
        $pdf->save('C:\wamp64\www\Proje\public\pdf\fatura.pdf');

        $mesaj =array('email'=>$gonderen);
        
        //var_dump($email);
        
        Mail::send('mailmesaj',$mesaj,function ($message)  use ($email,$gonderen,$name)
        {

            $dizi = explode (",",$email);

            $message->from($gonderen, $name);
            foreach ($dizi as $deger ) {
              $message->to($deger)->subject
              ('Fatura Bilgileri');
            }
            
            $message->attach('C:\wamp64\www\Proje\public\pdf\fatura.pdf');


        });

          //var_dump($fatura);
        $faturalar = Fatura::all();

        return redirect()->intended('faturalar')->with('success', "Mail Başarıyla Gönderildi",'faturalar' ,$faturalar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Fatura $fatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fatura $fatura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //Fatura::where('id', $id)->delete();
       return redirect()->intended('faturalar');
   }
}
