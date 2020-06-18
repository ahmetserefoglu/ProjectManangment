<?php

namespace App\Http\Controllers;

use App;
use App\Firmalar;
use App\Gorev;
use App\Gorusme;
use App\Proje;
use App\Task;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	public function lang($locale) {
		App::setLocale($locale);
		session()->put('locale', $locale);
		return redirect()->back();
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function react() {
		return view('layouts.app');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function translations() {
		return view('vendor.translation-manager.index');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		Log::info('A user has arrived at the welcome page.');
		$firmalar = Firmalar::all()->count();
		$gant = Gorev::all()->count();
		$projeler = Proje::all()->count();
		$gorusmeler = Gorusme::all()->count();
		$tasks = DB::select("select DATEDIFF(curdate(),t.start_date) as sonuc ,t.* from tasks t where t.user_id='" . Auth::user()->id . "' order by sonuc desc ");

		return view('home', ['page_title' => 'Anasayfa', 'firmalar' => $firmalar, 'gant' => $gant, 'projeler' => $projeler, 'gorusmeler' => $gorusmeler, 'tasks' => $tasks]);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function files() {
		return view('galeri', ['page_title' => 'Galeri']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function invoice() {
		return view('fatura.invoice', ['page_title' => 'Fatura']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function palet() {
		return view('palet.index', ['page_title' => 'Palet']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function projetakip() {
		return view('proje.projetakip', ['page_title' => 'Projeler']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function fileupload() {
		return view('fileuploads.fileupload', ['page_title' => 'File Upload']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function okulyonetimi() {
		return view('okulyonetimi.okulyonetimi', ['page_title' => 'Okul Yönetimi']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function okul() {
		return view('okullar.okul', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Okullar']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function okulogrencimaster() {
		return view('okullar.okulogrencilistesi', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Okul-Öğrenci']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function okulsinifmaster() {
		return view('okullar.okulsiniflistesi', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Okul-Sinif']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function okulvelimaster() {

		return view('okullar.okulvelilistesi', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Okul-Veli']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function okulogretmenmaster() {

		return view('okullar.okulogretmenlistesi', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Okul-Öğretmen']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function okullardetay($id = null) {
		return view('okullar.okullistesi', ['page_title' => 'Okullar', 'page_alt_title' => 'Okullar Listesi']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function okulekle() {
		return view('okullar.okulekle', ['page_title' => 'Okullar', 'page_alt_title' => 'Okullar Ekle']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ayarlar() {
		return view('ayarlar.ayarlar', ['page_title' => 'Ayarlar']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function dersler() {
		return view('dersler.ders', ['page_title' => 'Dersler']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sinavlar() {
		return view('sinavlar.sinavlar', ['page_title' => 'Sınavlar']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sorubankasi() {
		return view('sorubankasi.sorubankasi', ['page_title' => 'Soru Bankası']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function veliler() {
		return view('veliler.veli', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Veliler']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function duyurular() {
		return view('duyurular.duyuru', ['page_title' => 'Duyurular']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function duyuruekle() {
		return view('duyurular.duyuruekle', ['page_title' => 'Duyurular', 'page_alt_title' => 'Duyuru Ekle']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function iletisim() {
		return view('iletisim.iletisim', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'İletişim Bilgisi']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function odevler() {

		return view('odevler.odev', ['page_title' => 'Ödevler']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ogrenciodevler($sinif = '') {
		if ($sinif != null) {
			return view('odevler.ogrenciodevlistesi', ['page_title' => 'Ödevler', 'page_alt_title' => 'Öğrenci Ödev Listesi']);
		}

	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ogrenciodevver($sinif = '') {
		if ($sinif != null) {
			return view('odevler.odevver', ['page_title' => 'Ödevler', 'page_alt_title' => 'Öğrenci Ödev Ekle']);
		}

	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ogrenciozelodev($sinif = '') {
		if ($sinif != null) {
			return view('odevler.ogrenciozelodev', ['page_title' => 'Öğrenci Ödev Ekle']);
		}

	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function siniflar() {
		return view('siniflar.sinif', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Siniflar']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function siniflarlist($sinif = '') {
		if ($sinif != null) {
			return view('siniflar.siniflistesi', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Siniflar']);
		}

	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ogrenciler() {
		return view('ogrenciler.ogrenci', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Öğrenciler']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ogrencilerdetay() {
		return view('ogrenciler.ogrencilistesi', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Öğrenciler']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function velilerdetay() {
		return view('veliler.velilerdetay', ['page_title' => 'Veliler', 'page_alt_title' => 'Veliler Listesi']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function bildirim() {
		return view('bildirimler.bildirim', ['page_title' => 'bildirim']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ogretmenlistesi() {
		return view('ogretmenler.ogretmenlistesi', ['page_title' => 'Öğretmen Paneli', 'page_alt_title' => 'Öğretmenler Listesi']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ogretmenler() {
		return view('ogretmenler.ogretmen', ['page_title' => 'Okul Yönetimi', 'page_alt_title' => 'Öğretmenler']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ogretmenlerdetay($id = null) {
		if ($id != null) {
			return view('ogretmenler.ogretmendetay', ['page_title' => 'Öğretmen Paneli', 'page_alt_title' => 'Öğretmen Detay']);
		}

	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function mesajlar() {
		return view('mesajlar.mesaj', ['page_title' => 'Mesajlar']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sendMessage() {
		return view('mesajlar.sendmesaj', ['page_title' => 'Mesaj Gönder']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function kullanici() {
		return view('kullanici.kullanici', ['page_title' => 'Ayarlar Paneli', 'page_alt_title' => 'Kullanıcılar', 'page_alt_alt_title' => 'Kullanıcı Ekle']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function kullaniciEkle() {
		return view('kullanici.kullaniciekle', ['page_title' => 'Ayarlar Paneli', 'page_alt_title' => 'Kullanıcı Ekle']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function kullaniciRolleri() {
		return view('kullanici.roller', ['page_title' => 'Ayarlar Paneli', 'page_alt_title' => 'Kullanıcı Rolleri', 'page_alt_alt_title' => 'Kullanıcı Rol Ekle']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function task() {
		return view('task', ['page_title' => 'Görevler']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function datatables() {
		return view('datatable', ['page_title' => 'Task']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function vuetask() {
		return view('vuetask', ['page_title' => 'VUE TASK']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function test() {
		return view('test', ['page_title' => 'Test']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function shop() {
		return view('shopping', ['page_title' => 'Shopping']);
	}
}
