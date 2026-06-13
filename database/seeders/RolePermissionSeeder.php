<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ── Permissions ──────────────────────────────
        $permissions = [
            // Dashboard
            ['name' => 'View Dashboard',    'slug' => 'view-dashboard',    'group' => 'dashboard'],

            // Products
            ['name' => 'View Products',     'slug' => 'view-products',     'group' => 'products'],
            ['name' => 'Create Products',   'slug' => 'create-products',   'group' => 'products'],
            ['name' => 'Edit Products',     'slug' => 'edit-products',     'group' => 'products'],
            ['name' => 'Delete Products',   'slug' => 'delete-products',   'group' => 'products'],

            // Orders
            ['name' => 'View Orders',       'slug' => 'view-orders',       'group' => 'orders'],
            ['name' => 'Manage Orders',     'slug' => 'manage-orders',     'group' => 'orders'],

            // Settings
            ['name' => 'Manage Settings',   'slug' => 'manage-settings',   'group' => 'settings'],

            // Users
            ['name' => 'View Users',        'slug' => 'view-users',        'group' => 'users'],
            ['name' => 'Create Users',      'slug' => 'create-users',      'group' => 'users'],
            ['name' => 'Edit Users',        'slug' => 'edit-users',        'group' => 'users'],
            ['name' => 'Delete Users',      'slug' => 'delete-users',      'group' => 'users'],

            // Roles
            ['name' => 'View Roles',        'slug' => 'view-roles',        'group' => 'roles'],
            ['name' => 'Create Roles',      'slug' => 'create-roles',      'group' => 'roles'],
            ['name' => 'Edit Roles',        'slug' => 'edit-roles',        'group' => 'roles'],
            ['name' => 'Delete Roles',      'slug' => 'delete-roles',      'group' => 'roles'],
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['slug' => $p['slug']], $p);
        }

        // ── Roles ────────────────────────────────────

        // Super Admin — all permissions (checked via slug, not pivot)
        $superAdmin = Role::firstOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Admin', 'description' => 'Full access to everything', 'is_system' => true]
        );
        // Attach all permissions for reference
        $superAdmin->permissions()->sync(Permission::pluck('id'));

        // Admin — products, orders, settings, dashboard
        $admin = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'description' => 'Manage products, orders, and settings', 'is_system' => true]
        );
        $adminPerms = Permission::whereIn('slug', [
            'view-dashboard', 'view-products', 'create-products', 'edit-products', 'delete-products',
            'view-orders', 'manage-orders', 'manage-settings',
        ])->pluck('id');
        $admin->permissions()->sync($adminPerms);

        // Editor — view + edit products & settings
        $editor = Role::firstOrCreate(
            ['slug' => 'editor'],
            ['name' => 'Editor', 'description' => 'Edit products and site content', 'is_system' => true]
        );
        $editorPerms = Permission::whereIn('slug', [
            'view-dashboard', 'view-products', 'edit-products', 'manage-settings', 'view-orders',
        ])->pluck('id');
        $editor->permissions()->sync($editorPerms);
    }
}
