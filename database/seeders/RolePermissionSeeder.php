<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // --- Buat Permissions yang Granular (Detail) ---
        $permissions = [
            // Products
            'product: view',
            'product: create',
            'product: update',
            'product: delete',
            // Orders
            'order: view',
            'order: update',
            // Categories
            'category: view',
            'category: create',
            'category: update',
            'category: delete',
            // Store Galleries
            'gallery: view',
            'gallery: create',
            'gallery: update',
            'gallery: delete',
            // Customers (Users)
            'customer: view',
            // Employees (Pegawai)
            'employee: view',
            'employee: create',
            'employee: update',
            'employee: delete',
            // Reports
            'report: view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // --- Buat Roles dan berikan permissions ---

        // 1. Role Pembeli (Customer) - tidak punya permission dashboard
        Role::create(['name' => 'pembeli']);

        // 2. Role Pegawai (Admin) - Punya akses operasional penuh
        $pegawaiRole = Role::create(['name' => 'pegawai']);
        $pegawaiRole->givePermissionTo([
            'product: view',
            'product: create',
            'product: update',
            'product: delete',
            'order: view',
            'order: update',
            'category: view',
            'category: create',
            'category: update',
            'category: delete',
            'gallery: view',
            'gallery: create',
            'gallery: update',
            'gallery: delete',
            'customer: view',
        ]);

        // 3. Role Owner (Super Admin) - Bisa lihat semua, tapi edit terbatas
        $ownerRole = Role::create(['name' => 'owner']);
        $ownerRole->givePermissionTo([
            // Akses penuh untuk kelola pegawai
            'employee: view',
            'employee: create',
            'employee: update',
            'employee: delete',
            // Akses lihat laporan
            'report: view',
            // Akses "view-only" untuk data operasional
            'product: view',
            'order: view',
            'category: view',
            'gallery: view',
            'customer: view',
        ]);


        // --- Buat User Default ---

        // 1. Buat user Owner
        $owner = User::updateOrCreate(
            ['email' => 'owner@vidicosmetics.com'],
            [
                'name' => 'Vidi Owner',
                'password' => Hash::make('owner123'),
            ]
        );
        $owner->assignRole($ownerRole);

        // 2. Buat user Pegawai
        $pegawai = User::updateOrCreate(
            ['email' => 'pegawai@vidicosmetics.com'],
            [
                'name' => 'Vidi Pegawai',
                'password' => Hash::make('pegawai123'),
            ]
        );
        $pegawai->assignRole($pegawaiRole);
    }
}
