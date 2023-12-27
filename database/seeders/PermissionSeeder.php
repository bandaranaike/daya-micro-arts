<?php

namespace Database\Seeders;

use App\Config\PermissionEnum;
use App\Config\RolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminRole();

        $this->createUserRole();

        $this->createPermissions();

        $this->assignPermissionToAdminRoles();

        $adminUser = User::where('email', config('permission.admin_email'))->first();
        if ($adminUser) {
            $adminUser->assignRole(RolesEnum::ADMIN->value);
        }
    }

    private function createAdminRole(): void
    {
        Role::firstOrCreate(['name' => RolesEnum::ADMIN->value, 'guard_name' => 'admin']);
    }

    private function createUserRole(): void
    {
        Role::firstOrCreate(['name' => RolesEnum::USER->value, 'guard_name' => 'admin']);
    }

    private function createPermissions(): void
    {
        Permission::insert([
            ['name' => PermissionEnum::CREATE_ART->value, 'guard_name' => 'admin'],
            ['name' => PermissionEnum::DELETE_ART->value, 'guard_name' => 'admin'],
            ['name' => PermissionEnum::EDIT_ART->value, 'guard_name' => 'admin'],
        ]);
    }

    private function assignPermissionToAdminRoles(): void
    {
        $adminRole = Role::where('name', RolesEnum::ADMIN->value)->first();
        $adminRole->syncPermissions([PermissionEnum::CREATE_ART->value, PermissionEnum::DELETE_ART->value, PermissionEnum::EDIT_ART->value]);
    }
}
