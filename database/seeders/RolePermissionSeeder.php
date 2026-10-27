<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\CmsPermissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (CmsPermissions::all() as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $roles = [
            'Administrator' => CmsPermissions::all(),
            'News Editor' => [
                CmsPermissions::ACCESS_ADMIN,
                CmsPermissions::MANAGE_POSTS,
                CmsPermissions::MANAGE_CATEGORIES,
            ],
            'Procurement Officer' => [
                CmsPermissions::ACCESS_ADMIN,
                CmsPermissions::MANAGE_PROCUREMENTS,
            ],
            'Academics Officer' => [
                CmsPermissions::ACCESS_ADMIN,
                CmsPermissions::MANAGE_ACADEMICS,
            ],
            'Communications Officer' => [
                CmsPermissions::ACCESS_ADMIN,
                CmsPermissions::MANAGE_POSTS,
                CmsPermissions::MANAGE_CATEGORIES,
                CmsPermissions::MANAGE_CAROUSEL,
                CmsPermissions::MANAGE_TIPTTO,
                CmsPermissions::MANAGE_DIRECTOR_POSTS,
                CmsPermissions::MANAGE_HR_POSTS,
                CmsPermissions::MANAGE_SIT,
            ],
            'HR Officer' => [
                CmsPermissions::ACCESS_ADMIN,
                CmsPermissions::MANAGE_HR_POSTS,
                CmsPermissions::MANAGE_POSTS,
            ],
            'Officials Manager' => [
                CmsPermissions::ACCESS_ADMIN,
                CmsPermissions::MANAGE_OFFICIALS,
            ],
            'Admission Officer' => [
                CmsPermissions::ACCESS_ADMIN,
                CmsPermissions::MANAGE_ADMISSIONS,
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::findOrCreate($roleName, 'web');
            $role->syncPermissions($permissions);
        }

        // Existing boolean admins become Administrators
        User::query()
            ->where('is_admin', true)
            ->each(function (User $user) {
                $user->syncRoles(['Administrator']);
                $user->forceFill(['is_admin' => true])->save();
            });
    }
}
