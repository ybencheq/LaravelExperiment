<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

class PermissionTableSeeder2 extends Seeder
{
	
	//Note: every time you add new attributes (roles, permissions, users, etc...) you need to create a new seeder and run it to actually update your databse
	//can use php artisan tinker for updates in command line
	//mysql necessary for database exploration to navigate and see what changes are happening in the database (use homestead, show tables, select * from nameoftablehere, etc...)
	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		//making more users:
		$Facilities = new Role(); //limit Facilities stuff in controller
		$Facilities->name = 'Facilities';
		$Facilities->display_name = 'Facilities Person';
		$Facilities->description = 'Person is allowed to edit and delete Facilities TASKS ONLY'; //optional
		$Facilities->save();
		
		$user = User::where('email', '=', 'fart2@gmail.com')->first();
		// role attach alias
		$user->attachRole(Role::where('name', '=', 'Facilities')->first()); // parameter can be an Role object, array, or id
		
		
    }
}
