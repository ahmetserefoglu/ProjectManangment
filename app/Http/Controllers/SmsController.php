<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\SmsVerification;

class SmsController extends Controller
{
    //
	protected $code, $smsVerifcation;

	function __construct()
	{
		$this->smsVerifcation = new \App\SmsVerification();
	}


	public function index()
	{
		$smsverification=SmsVerification::orderBy('id', 'desc')->get();

		return view('sms.index',['page_title'=>'Sms','smsverification'=>$smsverification]);
	}
	/*
	Store
	*/
	public function store(Request $request)
	{
		$code = rand(1000, 9999); //generate random code
		$request['code'] = $code; //add code in $request body
		$this->smsVerifcation->store($request); //call store method of model
		return $this->sendSms($request); // send and return its response
	}

	public function sendSms($request)
	{
		$accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
		$authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
		$smsverification=SmsVerification::orderBy('created_at', 'asc')->get();
		try
		{
			$client = new Client(['auth' => [$accountSid, $authToken]]);
			$result = $client->post('https://api.twilio.com/2010-04-01/Accounts/AC037e3b3a9f8743ee90adb2283e7c8402/Messages.json',
				[
					'headers' => [
						'Content-Type' => 'application/x-www-form-urlencoded',
					],
					'form_params' => [
		 'Body' => 'CODE: '. $request->code, //set message body
		 'To' => $request->contact_number,
		 'From' => '+13344599247' //we get this number from twilio
		]]);
			//$result[0]
			$mesaj="Mesaj Başarıyla Gönderildi";
			

			return redirect()->intended('sendsms')->with('success',$mesaj ,'smsverification' ,$smsverification);
		}
		catch (Exception $e)
		{
			$mesaj= "Error: " . $e->getMessage();
			return redirect()->intended('sendsms')->with('success',$mesaj ,'smsverification' ,$smsverification);
		}
	}

	/*
	Verfiy Content
	*/
	public function verifyContact(Request $request)
	{
		$smsverification=SmsVerification::orderBy('created_at', 'DESC')->get();
		$accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
		$authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
		$smsVerifcation = 
		$this->smsVerifcation::where('contact_number','=',
			$request->contact_number)
		 ->latest() //show the latest if there are multiple
		 ->first();
		 if($request->code == $smsVerifcation->code)
		 {
		 	$request["status"] = 'verified';
		 	$smsVerifcation->updateModel($request);
		 	$msg["message"] = "verified";
		 	$mesaj="Telefon Güvenli Bir Şekilde Kaydedildi";
		 	try
			{

				$client = new Client(['auth' => [$accountSid, $authToken]]);
				$result = $client->post('https://api.twilio.com/2010-04-01/Accounts/AC037e3b3a9f8743ee90adb2283e7c8402/Messages.json',
					[
						'headers' => [
							'Content-Type' => 'application/x-www-form-urlencoded',
						],
						'form_params' => [
			 'Body' => 'MESAJ: '. 'https://www.google.com.tr/', //set message body
			 'To' => $request->contact_number,
			 'From' => '+13344599247' //we get this number from twilio
			]]);
				//$result[0]
			}
			catch (Exception $e)
			{
				$mesaj= "Error: " . $e->getMessage();
			}

			return redirect()->intended('sendsms')->with('success', $mesaj,'smsverification' ,$smsverification);
		 }
		 else
		 {
		 	$msg["message"] = "not verified";
		 	

			return redirect()->intended('sendsms')->with('success', $msg["message"],'smsverification' ,$smsverification);
		 }
		}


	}
