<?php

namespace Database\Seeders;

use App\Enum\Permissions;
use App\Enum\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء الأدوار
        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $commenterRole = Role::create(['name' => RolesEnum::Commenter->value]);
        $adminRole = Role::create(['name' => RolesEnum::Admin->value]);

        // إنشاء الصلاحيات
        $manageFeaturesPermission = Permission::create(['name' => Permissions::ManageFeatures->value]);
        $manageCommentsPermission = Permission::create(['name' => Permissions::ManageComments->value]);
        $manageUsersPermission = Permission::create(['name' => Permissions::ManageUsers->value]);
        $upvoteDownvotePermission = Permission::create(['name' => Permissions::UpvoteDownvote->value]);

        // ربط الصلاحيات بالأدوار
        $userRole->syncPermissions([
            $upvoteDownvotePermission,
        ]);

        $adminRole->syncPermissions([
            $upvoteDownvotePermission,
            $manageCommentsPermission,
            $manageUsersPermission,
            $manageFeaturesPermission,
        ]);

        $commenterRole->syncPermissions([
            $upvoteDownvotePermission,
            $manageCommentsPermission,
        ]);

        // إنشاء مستخدم تجريبي مع دور
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->assignRole(RolesEnum::User->value);

        User::factory()->create([
            'name' => 'Commenter User',
            'email' => 'commenter@example.com',
        ])->assignRole(RolesEnum::Commenter->value);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ])->assignRole(RolesEnum::Admin->value);
    }
}
