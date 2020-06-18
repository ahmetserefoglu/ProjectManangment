<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsVerification extends Model
{
    //
    protected $fillable = [
	 'contact_number','code','status','created_at','updated_at' 
	 ];

	/*
	Store
	*/ 
	public function store($request)
	{
		$this->fill($request->all());
	 	$sms = $this->save();
	 	return response()->json($sms, 200);
	}
	
	/*
	Update Model
	*/
	public function updateModel($request)
	{
	 	$this->update($request->all());
	 	return $this;
	}
}
