<?php

class TaskController {

	public function index()
	{
		return View::make('index.php', array('tasks' => Task::all()));
	}

	public function create()
	{
		return View::make('create.php'); 
	}

	public function store()
	{
		$input = Input::allPost();
		$task = new Task;
		$task->name = $input['task'];
		$task->save();

		Redirect::to(Url::generate('task.index'));
	}

	public function show($id)
	{
		return View::make('show.php', array('task' => Task::find($id)));
	}

	public function edit($id)
	{
		return View::make('edit.php', array('task' => Task::find($id)));
	}

	public function update($id)
	{
		$input = Input::allPost();

		$task = Task::find($id);
		$task->name = $input['task'];
		$input['finished'] = (isset($input['finished']) ?: 0);
		$task->finished = $input['finished'];
		$task->save();

		Redirect::to(Url::generate('task.show', array('id' => $task->id)));

	}

	public function destroy($id)
	{
		$task = Task::find($id);
		$task->delete();

		Redirect::to(Url::generate('task.index'));
	}

}
