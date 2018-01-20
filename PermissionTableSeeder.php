<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//making my roles
		$admin = new Role();
		$admin->name = 'admin';
		$admin->display_name = 'Task Administrator'; // optional
		$admin->description  = 'This user is allowed to view, edit, create and delete ALL TASKS'; //optional
		$admin->save();
		
		$IT = new Role(); //limit IT stuff in controller
		$IT->name = 'IT';
		$IT->display_name = 'IT Person';
		$IT->description = 'Person is allowed to edit and delete IT TASKS ONLY'; //optional
		$IT->save();
		
		
		//making my users:
		
		$user = User::where('email', '=', 'alynaj36@gmail.com')->first(); //me as temporary user = admin 
		// role attach alias
		$user->attachRole($admin); // parameter can be an Role object, array, or id
		
		/*so at this point the above one is stored in database and now this one is 
		overwriting the user variable above but still storing a new relationship in database as an IT person */
		$user = User::where('email', '=', 'moroccoyazzy@msn.com')->first(); 
		// role attach alias
		$user->attachRole($IT); // parameter can be an Role object, array, or id

		
		//making my permissions
		$createTask = new Permission();
		$createTask->name = 'create-task';
		$createTask->display_name = 'Create Tasks'; // optional
		// Allow a user to...
		$createTask->description  = 'create new tasks'; // optional
		$createTask->save();
		
		//making my permissions
		$deleteTask = new Permission();
		$deleteTask->name = 'delete-task';
		$deleteTask->display_name = 'Delete Tasks'; // optional
		// Allow a user to...
		$deleteTask->description  = 'delete new tasks'; // optional
		$deleteTask->save();
		
		//making my permissions
		$editTask = new Permission();
		$editTask->name = 'edit-task';
		$editTask->display_name = 'Edit Tasks'; // optional
		// Allow a user to...
		$editTask->description  = 'edit new tasks'; // optional
		$editTask->save();
		
		$admin->attachPermissions(array($createTask, $deleteTask, $editTask)); //so now admin has permission to do any of these
		//would make more permissions but more complicated since I would want roles to be able to edit/delete only THEIR OWN department tasks and I can't limit that here
		
		
		
    }
}
