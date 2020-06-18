<?php

namespace App\Http\Controllers;

use App\Firmalar;
use App\Proje;
use App\Projedetay;
use App\ProjeDosyalari;
use App\ProjeKisiler;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjeController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//

		/*if(Auth::user()->rolename=='User'){
			            $proje = DB::select("SELECT a.*,SUM(b.Durumu) as toplam FROM projes a Inner JOIN projedetay b on a.id=b.proje_id WHERE a.Kisiler=".Auth::user()->name. "  GROUP BY a.BaslangicTarihi,a.BitisTarihi,a.DosyaAdi,a.id,a.Durumu,a.FirmaAdi,a.Icerik,a.Kisiler,a.ProjeAdi,a.Sure");

			            //$proje = Proje::where('Kisiler',Auth::user()->name)->get();
			        }else{
			           $proje = DB::select("SELECT a.*,SUM(b.Durumu) as toplam FROM projes a Inner JOIN projedetay b on a.id=b.proje_id WHERE a.user_id=".Auth::user()->id. "  GROUP BY a.BaslangicTarihi,a.BitisTarihi,a.DosyaAdi,a.id,a.user_id,a.updated_at,a.created_at,a.Durumu,a.FirmaAdi,a.Icerik,a.Kisiler,a.ProjeAdi,a.Sure");
			           //$proje = Proje::where('user_id',Auth::user()->id)->get();
		*/
		//$proje = Proje::where('user_id',Auth::user()->id)->get();
		$proje = DB::select("SELECT
DISTINCT p.*,SUM((((((pkisi.durum*p.Sure)/100)*pdetay.Durumu)))/p.Sure) as toplam
FROM projes p
Inner JOIN projedetay pdetay on p.id=pdetay.proje_id
Inner JOIN proje_kisilers pkisi on pkisi.proje_id=pdetay.proje_id and pdetay.user_id=pkisi.userid
GROUP BY p.BaslangicTarihi,p.BitisTarihi,p.DosyaAdi,p.id,p.user_id,p.updated_at,p.created_at,p.Durumu,p.FirmaAdi,p.Icerik,p.Kisiler,p.ProjeAdi,p.Sure");

		$projes['proje'] = DB::table('department')
		// 	->join('projedetay', 'projes.id', '=', 'projedetay.proje_id')
		// 	->join('proje_kisilers', 'proje_kisilers.proje_id', '=', 'projedetay.proje_id')
		// 	->select('projes.*', DB::raw('SUM((((proje_kisilers.durum*projes.Sure)/100)*projedetay.Durumu)/projes.Sure) as toplam'))
		// // ->join('proje_kisilers', function ($join) {
		// //           $join->on('proje_kisilers.proje_id', '=', 'projedetay.proje_id')-
		// //           $join->on('proje_kisilers.userid', '=', 'projedetay.user_id')
		// //       })
		// 	->groupBy('projes.BaslangicTarihi', 'projes.BitisTarihi', 'projes.DosyaAdi', 'projes.id', 'projes.user_id', 'projes.updated_at', 'projes.created_at',
		// 		'projes.Durumu',
		// 		'projes.FirmaAdi',
		// 		'projes.Icerik',
		// 		'projes.Kisiler',
		// 		'projes.ProjeAdi',
		// 		'projes.Sure')
			->get();

		$projes['proje']['sonuc'] = DB::table('projes')
			->join('projedetay', 'projes.id', '=', 'projedetay.proje_id')
			->join('proje_kisilers', 'proje_kisilers.proje_id', '=', 'projedetay.proje_id')
			->select('projes.*', DB::raw('SUM((((proje_kisilers.durum*projes.Sure)/100)*projedetay.Durumu)/projes.Sure) as toplam'))
		// ->join('proje_kisilers', function ($join) {
		//           $join->on('proje_kisilers.proje_id', '=', 'projedetay.proje_id')-
		//           $join->on('proje_kisilers.userid', '=', 'projedetay.user_id')
		//       })
			->groupBy('projes.BaslangicTarihi', 'projes.BitisTarihi', 'projes.DosyaAdi', 'projes.id', 'projes.user_id', 'projes.updated_at', 'projes.created_at',
				'projes.Durumu',
				'projes.FirmaAdi',
				'projes.Icerik',
				'projes.Kisiler',
				'projes.ProjeAdi',
				'projes.Sure')
			->get();

		// foreach ($projes as $k => $v) {
		// 	var_export($projes[$k][0]->name);
		// 	foreach ($v['sonuc'] as $value) {
		// 		//echo $value->FirmaAdi;
		// 	}

		// }

		// // dd($projes);
		// exit;
		return view('projeler.index', ['page_title' => 'Projeler', 'projeler' => $proje]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		$firmalar = Firmalar::all();
		$kisiler = User::all();

		return view('projeler.create', ['page_title' => 'Projeler', 'firmalar' => $firmalar, 'kisiler' => $kisiler]);
	}

	public function dosyalar($id) {
		$dosyalar = FileUpload::where('proje_id', $id)->get();

		if ($dosyalar->count() > 0) {
			$dosya2 = var_dump($dosyalar);
			//$dosya2 = DB::table('uploads')->whereIn('file_upload_id', array($dosyalar[0]->id))->get();
		} else {
			$dosya2 = "bulunamadı";
		}

		return compact('dosya2');

	}

	public function dosya($id) {
		$gallery = Projedetay::findorFail($id);

		return view('projeler.dosya')->with('gallery', $gallery);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
		$this->validate($request, [
			'ProjeAdi' => 'required|max:255',
			'FirmaAdi' => 'required|max:255',
			'Icerik' => 'required|max:255',
			'Kisiler' => 'required',
			'Sure' => 'required|numeric',
			'Durumu' => 'required',
			'BaslangicTarihi' => 'required',
			'BitisTarihi' => 'required',
		]);

		$kisiler = implode(',', request('Kisiler'));

		if (request('BaslangicTarihi') < request('BitisTarihi')) {
			$proje = Proje::create([
				'ProjeAdi' => request('ProjeAdi'),
				'FirmaAdi' => request('FirmaAdi'),
				'Icerik' => request('Icerik'),
				'Kisiler' => $kisiler,
				'Sure' => request('Sure'),
				'Durumu' => request('Durumu'),
				'BaslangicTarihi' => request('BaslangicTarihi'),
				'BitisTarihi' => request('BitisTarihi'),
				'user_id' => Auth::user()->id,
			]);
		} else {
			return view('projeler.index', ['success' => 'Başlangıc Tarihi Bitis Tarihinden büyük Olamaz']);
		}

		$proje = Proje::all();

		return view('projeler.index', ['success' => 'Gorusme Kaydedildi', 'projeler' => $proje]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Proje  $proje
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
		return response()->json(
			Proje::where('id', $id)
				->where('Kisiler', Auth::user()->id)
				->first()
		);
	}

	public function projedurum($id) {

		$fileuploads = Projedetay::where('proje_id', $id)->get();

		if (Auth::user()->rolename == 'User') {
			$projeler = Proje::where('Kisiler', Auth::user()->id)->get();
		} else {
			$projeler = Proje::findOrFail($id);
		}

		return view('projeler.projedurumekle', ['page_title' => 'Proje Durum', 'id' => $id, 'projeler' => $projeler]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Proje  $proje
	 * @return \Illuminate\Http\Response
	 */
	public function projedetayguncelle($id) {
		//
		//$projedetay = DB::select("SELECT * FROM projedetay WHERE proje_id=".$id);
		$projedetay = Projedetay::where('proje_id', $id)->firstOrFail();

		return view('projeler.projedurumdetay', ['projedetay' => $projedetay]);
	}

	public function detay($id) {
		$fileuploads = Projedetay::where('proje_id', $id)->get();

		//$fileuploads = DB::select("SELECT a.* FROM projedetay a Inner JOIN projes b on b.id=a.proje_id WHERE b.proje_id=".$id);

		if (Auth::user()->rolename == 'User') {
			$projeler = Proje::where('Kisiler', Auth::user()->id)->get();
		} else {
			$projeler = Proje::all();
		}

		$dosya = Projedetay::where('proje_id', $id)->get();

		return view('projeler.detay', ['page_title' => 'Proje Detaylari', 'id' => $id, 'projedetay' => $fileuploads]);
	}

	public function kisiler($id) {
		$projekisiler = ProjeKisiler::where('proje_id', $id)->get();

		//$kisiler=explode(',',$fileuploads[0]->Kisiler);

		//$fileuploads = DB::select("SELECT a.* FROM projedetay a Inner JOIN projes b on b.id=a.proje_id WHERE b.proje_id=".$id);

		return view('projeler.kisiler', ['page_title' => 'Proje Kisileri', 'id' => $id, 'projedetay' => $projekisiler]);
	}

	public function projedurumkisi($id) {

		$projeler = Proje::find($id);
		$kisiler = User::all();
		//$projeler=Proje::where('id',$id)->get();

		return view('projeler.projekisidurumekle', ['page_title' => 'Proje Durum', 'id' => $id, 'projeler' => $projeler, 'kisiler' => $kisiler]);
	}
	public function projekisidurumekle(Request $request, $id) {
		//
		//$proje=Proje::findOrFail($id);

		$user = User::findOrFail(request('kisi'));

		$proje = ProjeKisiler::create([
			'proje_id' => $id,
			'userid' => $user->id,
			'isim' => $user->name,
			'durum' => request('durum'),
			'user_id' => Auth::user()->id,
		]);

		/*$request->validate([
			        'kisiler' => 'required',
			        'durum'  => 'required'
		*/

		/*auth()->user()->projekisiler()->create([
			        'kisi' => $request->get('kisi'),
			        'proje_id' => $id,
			        'durum' => $request->get('durum')
		*/

		/* if(Auth::user()->rolename=='User'){
			         $input = [
			            'Durumu' =>$request->get('durumu'),
			        ];

			            Proje::where('id', $id)
			            ->update($input);
			        }else{
			            $input = [
			            'Durumu' =>$request->get('durumu'),
			        ];
			        Proje::where('id', $id)
			            ->update($input);
		*/

		$proje = ProjeKisiler::where('proje_id', $id)->get();
		return redirect()->intended('projeler/kisiler/' . $id)->with('success', 'Kaydedildi', 'projedetay', $proje);
	}

	public function projekisiguncelle($id) {
		//$proje=Proje::findOrFail($id);
		$projedetay = ProjeKisiler::where('id', $id)->firstOrFail();
		$kisiler = User::all();
		return view('projeler.projekisidurumguncelle', ['projeler' => $projedetay, 'kisiler' => $kisiler]);
	}

	public function projekisidetayguncelle(Request $request, $id) {
		//$proje=Proje::findOrFail($id);
		$projedetay = ProjeKisiler::where('id', $id)->firstOrFail();

		$user = User::findOrFail(request('kisi'));

		$input = [
			'proje_id' => $projedetay->proje_id,
			'userid' => $user->id,
			'isim' => $user->name,
			'durum' => request('durum'),
			'user_id' => Auth::user()->id,
		];

		ProjeKisiler::where('id', $id)
			->update($input);

		$proje = ProjeKisiler::where('proje_id', $projedetay->proje_id)->get();

		return redirect()->intended('projeler/kisiler/' . $projedetay->proje_id)->with('success', 'Güncellendi', 'projedetay', $proje);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Proje  $proje
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		$proje = Proje::findOrFail($id);
		$firmalar = Firmalar::all();
		$kisiler = User::all();

		return view('projeler.edit', ['projeler' => $proje, 'firmalar' => $firmalar, 'kisiler' => $kisiler]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Proje  $proje
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
		if (Auth::user()->rolename == 'User') {
			$proje = Proje::where('id', $id)->get();
			$input = [
				'Durumu' => $request['Durumu'],
			];

		} else {
			$this->validate($request, [
				'ProjeAdi' => 'required|max:255',
				'FirmaAdi' => 'required',
				'Icerik' => 'required|max:255',
				'Kisiler' => 'required',
				'Sure' => 'required|numeric',
				'Durumu' => 'required',
				'BaslangicTarihi' => 'required',
				'BitisTarihi' => 'required',
			]);

			$input = [
				'ProjeAdi' => $request['ProjeAdi'],
				'FirmaAdi' => $request['FirmaAdi'],
				'Icerik' => $request['Icerik'],
				'Kisiler' => $request['Kisiler'],
				'Sure' => $request['Sure'],
				'Durumu' => $request['Durumu'],
				'BaslangicTarihi' => $request['BaslangicTarihi'],
				'BitisTarihi' => $request['BitisTarihi'],
				'user_id' => Auth::user()->id,
			];
		}

		Proje::where('id', $id)
			->update($input);

		$proje = Proje::all();

		return redirect()->intended('projeler')->with('success', 'Görüşme Kaydedildi', 'projeler', $proje);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Proje  $proje
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
		Proje::where('id', $id)->delete();
		return redirect()->intended('projeler');
	}

	public function upload(Request $request) {
		$uploadedFile = $request->file('file');
		$filename = time() . $uploadedFile->getClientOriginalName();

		Storage::disk('local')->putFileAs(
			'files/' . $filename,
			$uploadedFile,
			$filename
		);

		$uploadedFile->move(public_path('gallery/images'), $filename);

		$gallery = Projedetay::find($request->input('file_id'));

		$upload = $gallery->projedosyalari()->create([
			'projedetay_id' => $request->input('file_id'),
			'filename' => $filename,
			'file_size' => $uploadedFile->getClientSize(),
			'file_path' => '/gallery/images/' . $filename,
			'user_id' => Auth::user()->id,
			'proje_id' => $gallery->proje["id"],
		]);

		$upload->save();
		return response()->json([
			'id' => $upload->id,
		]);
	}

	public function projedurumekle(Request $request, $id) {
		//
		$proje = Proje::findOrFail($id);

		$request->validate([
			'proje_detay_baslik' => 'required:max:255',
			'proje_detay' => 'required',
			'durumu' => 'required',
		]);

		auth()->user()->projedetay()->create([
			'proje_detay_baslik' => $request->get('proje_detay_baslik'),
			'proje_detay' => $request->get('proje_detay'),
			'proje_id' => $id,
			'durumu' => $request->get('durumu'),
		]);

		if (Auth::user()->rolename == 'User') {
			$input = [
				'Durumu' => $request->get('durumu'),
			];

			Proje::where('id', $id)
				->update($input);
		} else {
			$input = [
				'Durumu' => $request->get('durumu'),
			];
			Proje::where('id', $id)
				->update($input);
		}

		$fileuploads = Projedetay::where('user_id', Auth::user()->id)->get();
		return redirect()->intended('projeler')->with('success', 'Görüşme Kaydedildi', 'fileuploads', $fileuploads);
	}

	public function projedurumguncelle(Request $request, $id) {
		//$proje=Proje::findOrFail($id);

		$request->validate([
			'proje_detay_baslik' => 'required:max:255',
			'proje_detay' => 'required',
			'durumu' => 'required',
		]);

		/*auth()->user()->projedetay()->update([
			        'proje_detay_baslik' => $request->get('proje_detay_baslik'),
			        'proje_detay' => $request->get('proje_detay'),
			        'durumu' => $request->get('durumu')
		*/

		$input = [
			'proje_detay_baslik' => $request->get('proje_detay_baslik'),
			'proje_detay' => $request->get('proje_detay'),
			'durumu' => $request->get('durumu'),
		];

		Projedetay::where('proje_id', $id)
			->update($input);

		/*if(Auth::user()->rolename=='User'){
			         $input = [
			            'Durumu' =>$request->get('durumu'),
			        ];

			            Proje::where('id', $id)
			            ->update($input);
			        }else{
			            $input = [
			            'Durumu' =>$request->get('durumu'),
			        ];
			        Proje::where('id', $id)
			            ->update($input);
		*/

		$fileuploads = Projedetay::where('user_id', Auth::user()->id)->get();
		return redirect()->intended('projeler/detay/' . $id)->with('success', 'Görüşme Kaydedildi', 'projedetay', $fileuploads);
	}

}
