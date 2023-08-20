<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'upload media']);

        $author = Role::create(['name' => 'author']);
        $author->givePermissionTo('create posts');
        $author->givePermissionTo('edit posts');
        $author->givePermissionTo('delete posts');
        $author->givePermissionTo('publish posts');
        $author->givePermissionTo('upload media');

        $admin = Role::create(['name' => 'administrator']);
        $admin->givePermissionTo(Permission::all());
    }
}
