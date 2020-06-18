<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proje extends Model {
	//

	protected $fillable = [
		'id',
		'ProjeAdi',
		'FirmaAdi',
		'Durumu',
		'Sure',
		'Kisiler',
		'BaslangicTarihi',
		'BitisTarihi',
		'Icerik',
		'user_id',
	];

	public function fileuploads() {
		return $this->hasMany('App\FileUpload');
	}

	public function projedetay() {
		return $this->hasMany('App\Projedetay');
	}

	public function user() {
		return $this->hasMany('App\User');
	}

	public function projekisiler() {
		return $this->hasMany('App\ProjeKisiler');
	}
}
