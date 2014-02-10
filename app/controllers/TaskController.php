<?php

class TaskController {

	public function index()
	{
		return View::make('index.php', array('tasks' => Task::all()));
	}

	public function create()
	{
		Guard::protect();

		return View::make('create.php'); 
	}

	public function store()
	{
		Guard::protect();

		$input = Input::allPost();

		if(strlen($input['task']) < 4) {
			Session::getFlashBag()->add('warning', 'Task name too short!');
			Redirect::to(Url::generate('task.create'));
			return false;
		}

		$task = new Task;
		$task->name = $input['task'];
		$task->save();

		Session::getFlashBag()->add('message', 'Added new task!');
		Redirect::to(Url::generate('task.index'));
	}

	public function show($id)
	{
		return View::make('show.php', array('task' => Task::find($id)));
	}

	public function edit($id)
	{
		Guard::protect();

		return View::make('edit.php', array('task' => Task::find($id)));
	}

	public function update($id)
	{
		Guard::protect();

		$input = Input::allPost();

		if(strlen($input['task']) < 4) {
			Session::getFlashBag()->add('warning', 'Task name too short!');
			Redirect::to(Url::generate('task.edit', array('id' => $id)));
			return false;
		}

		$task = Task::find($id);
		$task->name = $input['task'];
		$input['finished'] = (isset($input['finished']) ?: 0);
		$task->finished = $input['finished'];
		$task->save();

		Session::getFlashBag()->add('message', 'Updated task!');
		Redirect::to(Url::generate('task.show', array('id' => $task->id)));

	}

	public function destroy($id)
	{
		Guard::protect();

		$task = Task::find($id);
		$task->delete();

		Session::getFlashBag()->add('message', 'Removed task!');
		Redirect::to(Url::generate('task.index'));
	}

}
