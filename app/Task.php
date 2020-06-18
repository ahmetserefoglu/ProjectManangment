<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
	//
	protected $fillable = ['user_id', 'name', 'description', 'start_date', 'end_date'];

	public function user() {
		return $this->belongsTo(User::class, 'user_id');
	}
}
