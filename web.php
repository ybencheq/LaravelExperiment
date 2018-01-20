<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;
use Illuminate\Http\Request;


//this part is from the vue/javascript tutorial (newer one) with authentication
Route::get('manage-vue', 'VueTaskController@manageVue');
Route::resource('vuetasks', 'VueTaskController');

Auth::routes(); //All Laravel 'Auth' routes

Route::get('/home', 'HomeController@index')->name('home'); //home = manage-vue (configured so that you can only access if logged in)




 /*------ everything below is from CRUD tutorial------*/
 
 

Route::resource('taskCRUD', 'TaskCRUDController');


/*note: all of the stuff inside these routes is actually what's usually in a controller, and the routes usually call the controller to do all of it*/

Route::get('/', function () {
    
	$tasks = Task::orderBy('created_at', 'asc')->get(); /*ordering the tasks by ascending date of creation*/
	
	return view('tasks', [ /*return all the tasks*/
			'tasks' => $tasks
		]);
});

Route::post('/task', function (Request $request) {
	
		$validator = Validator::make($request->all(), [ /*validate the request with the first name being no more tahn 255 characters long*/
			'name'=> 'required|max:255',
		]);
		
		if ($validator->fails()) { /*if the validation fails then redirect them home, flash old input and display errors*/
				return redirect('/')
					->withInput()
					->withErrors($validator);
		}

		
		/*now must create task*/
		
		$task = new Task; /*create task object*/
		$task->name = $request->name; /*assign its first name*/
		$task->save(); /*save it*/
		
		
		return redirect('/');
});

Route::delete('/task/{id}', function ($id) {
		Task::findOrFail($id)->delete();
		
		return redirect('/');
});

