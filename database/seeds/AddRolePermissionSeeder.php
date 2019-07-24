<?php

use Illuminate\Database\Seeder;

class AddRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = [
            'name' => 'user',
            'label' => 'Usuario'
        ];
        $data_role = \App\Entities\Role::create($role);


    }
}
