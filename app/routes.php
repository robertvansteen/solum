<?php

Route::get('task.index', '/', 'TaskController::index');
Route::get('task.create', 'create', 'TaskController::create');
Route::post('task.store', 'store', 'TaskController::store');
Route::get('task.show', 'task/{id}', 'TaskController::show', 'id', null);
Route::get('task.edit', 'task/{id}/edit', 'TaskController::edit', 'id', null);
Route::put('task.update', 'task/{id}', 'TaskController::update', 'id', null);
Route::delete('task.destroy', 'task/{id}', 'TaskController::destroy', 'id', null);
