<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [TaskController::class, 'getTasks'])->name('get_tasks');
Route::get('/project/findtasks', [TaskController::class, 'findProjectTasks'])->name('find_project_tasks');
Route::get('/task/{id}', [TaskController::class, 'getTask'])->name('get_task');
Route::put('/task/update', [TaskController::class, 'updateTask'])->name('update_task');
Route::delete('/task/drop', [TaskController::class, 'dropTask'])->name('drop_task');
Route::post('/post/task', [TaskController::class, 'postTask'])->name('post_task');
Route::post('/task/task_order_change', [TaskController::class, 'taskOrderChange'])->name('task.order_change');
Route::get('/refresh-csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});




