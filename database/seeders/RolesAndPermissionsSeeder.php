<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Section;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // create permissions
        $section = Section::create(['name' => 'users', 'translation' => 'usuarios']);
        Permission::create(['name' => 'index users', 'section_id' => $section->id]);
        Permission::create(['name' => 'create users', 'section_id' => $section->id]);
        Permission::create(['name' => 'edit users', 'section_id' => $section->id]);
        Permission::create(['name' => 'delete users', 'section_id' => $section->id]);

         // create admin role
         $role = Role::create(['name' => 'admin']);
         $role->givePermissionTo(Permission::all());
         
         $role = Role::create(['name' => 'usuario']);
         $role = Role::create(['name' => 'evaluador']);
    }
}
