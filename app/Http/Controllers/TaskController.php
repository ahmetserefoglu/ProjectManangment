<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {

	/**
	 *
	 *
	 * @return auth
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		$tasks = request()->user()->tasks;

		return view('task.index', ['tasks' => $tasks]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//

		return view('task.create');
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
			'name' => 'required|max:255',
			'description' => 'required',
		]);

		$task = Task::create([
			'name' => request('name'),
			'description' => request('description'),
			'user_id' => Auth::user()->id,
			'start_date' => request('start_date'),
		]);

		$tasks = Task::all();

		return view('task.index', ['success' => 'Gorusme Kaydedildi', 'tasks' => $tasks]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
		return response()->json(
			Task::where('id', $id)
				->where('user_id', Auth::user()->id)
				->first()
		);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$task = Task::findOrFail($id);

		return view('task.edit', ['task' => $task]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Task $task) {
		//
		$this->validate($request, [
			'name' => 'required|max:255',
			'description' => 'required',
		]);

		$task->name = request('name');
		$task->description = request('description');
		$task->start_date = request('start_date');
		$task->save();

		$tasks = Task::all();
		return redirect()->intended('tasks')->with('success', 'Gorusme Kaydedildi', 'tasks', $tasks);
	}

	public function ajaxUpdate(Request $request) {

		if ($request->id) {
			$task = Task::find($request->id);

			$task->user_id = 1;
			$task->name = $request->name;
			$task->start_date = $request->start_date;
			$task->end_date = $request->end_date;
			$task->save();
		}else{
			$task = Task::create([
			'name' => $request->name,
			'user_id' => Auth::user()->id,
			'start_date' => $request->start_date,
			'end_date' => $request->end_date
		]);
		}
		

		


		return response()->json(['task' => $task]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
		Gorusme::where('id', $id)->delete();
		return redirect()->intended('tasks');
	}
}
