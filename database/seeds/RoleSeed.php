<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin',"Approval","User"];
        foreach ($roles as $role) {
            \App\Role::create([
                'name'=> $role
            ]);
        }
    }
}
