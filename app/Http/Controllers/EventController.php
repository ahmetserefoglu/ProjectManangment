<?php

namespace App\Http\Controllers;

use App\Event;
use App\Task;
use Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class EventController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		$events = [];
		$data = Event::all();
		if ($data->count()) {
			foreach ($data as $key => $value) {
				$events[] = Calendar::event(
					$value->title,
					true,
					new \DateTime($value->start_date),
					new \DateTime($value->end_date . ' +1 day'),
					null,
					// Add color and link on event
					[
						'color' => '#ff0000',
						'url' => 'pass here url and any route',
					]
				);
			}
		}
		$page_title = 'Etkinlik';
		$calendar_details = Calendar::addEvents($events);
		$tasks = Task::all();
		return view('event', compact('calendar_details', 'tasks', 'page_title'));
		/*$page_title='Etkinlik';
			        $page_alt_title='Etkinlik Takvimi';
		*/
	}

	public function addEvent(Request $request) {
		$validator = Validator::make($request->all(), [
			'event_name' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
		]);
		if ($validator->fails()) {
			\Session::flash('warnning', 'Lütfen Değerleri Doğru Giriniz');
			return Redirect::to('/etkinlik')->withInput()->withErrors($validator);
		}
		$event = new Event;
		$event->title = $request['event_name'];
		$event->start_date = $request['start_date'];
		$event->end_date = $request['end_date'];
		$event->save();
		\Session::flash('success', 'Etkinlik Başarıyla Eklendi');
		return Redirect::to('/etkinlik');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function taskEvent() {
		//
		$events = [];
		$data = Event::all();
		if ($data->count()) {
			foreach ($data as $key => $value) {
				$events[] = Calendar::event(
					$value->title,
					true,
					new \DateTime($value->start_date),
					new \DateTime($value->end_date . ' +1 day'),
					null,
					// Add color and link on event
					[
						'color' => '#ff0000',
						'url' => 'pass here url and any route',
					]
				);
			}
		}
		$page_title = 'Etkinlik';
		$calendar_details = Calendar::addEvents($events);
		$tasks = Task::all();
		return view('fullcalender', compact('calendar_details', 'tasks', 'page_title'));
		/*$page_title='Etkinlik';
			                    $page_alt_title='Etkinlik Takvimi';
		*/
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function show(Event $event) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Event $event) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Event $event) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Event $event) {
		//
	}
}
