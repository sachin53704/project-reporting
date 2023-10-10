<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin123',
            'mobile' => '9999999999',
            'password' => bcrypt('admin123')
        ]);

        // $user->assignRole($req->assign_role);
        Permission::create(['name' => 'dashboard.view']);
        Permission::create(['name' => 'user.view']);
        Permission::create(['name' => 'user.add']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'role.view']);
        Permission::create(['name' => 'role.add']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'permission.view']);
        Permission::create(['name' => 'permission.add']);
        Permission::create(['name' => 'permission.edit']);
        Permission::create(['name' => 'project.view']);
        Permission::create(['name' => 'project.add']);
        Permission::create(['name' => 'project.edit']);
        Permission::create(['name' => 'work_status.view']);
        Permission::create(['name' => 'work_status.add']);
        Permission::create(['name' => 'work_status.edit']);
        Permission::create(['name' => 'task.view']);
        Permission::create(['name' => 'task.add']);
        Permission::create(['name' => 'task.edit']);

        $superAdmin =Role::create(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo('dashboard.view', 'user.view', 'user.add', 'user.edit', 'role.view', 'role.add', 'role.edit', 'permission.view', 'permission.add', 'permission.edit', 'project.view', 'project.add', 'project.edit', 'work_status.view', 'work_status.add', 'work_status.edit', 'task.view', 'task.add', 'task.edit');

        $superAdmin =Role::create(['name' => 'User']);
        $superAdmin->givePermissionTo('dashboard.view', 'task.view', 'task.add', 'task.edit');

        $user = User::where('username','admin123')->first();

        $user->assignRole('Super Admin');
    }
}
