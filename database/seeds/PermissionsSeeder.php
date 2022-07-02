<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //clears permission cache before running
        app()['cache']->forget('spatie.permission.cache');

        //create permissions

        Permission::create(['name' => 'edit thread']);
        Permission::create(['name' => 'edit reply']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'edit news']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'edit rank']);


        Role::create(['name' => 'Banned']); // All permissions revoked

        Role::create(['name' => 'User']); // Regular permissions

        $role = Role::create(['name' => 'Staff']); // Edit / Delete other peoples posts, etc
        $role->givePermissionTo(['edit thread', 'edit reply', 'edit user']);

        $role = Role::create(['name' => 'Administrator']); // This gets almost all permissions
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Owner']); // This gets all permissions
        $role->givePermissionTo(Permission::all());
    }
}
