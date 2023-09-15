<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['admin', 'user'];

        foreach ($data as $role) {
            // cek jika ada data yang sama jangan disimpan
            $cek = Role::where('name', $role)->first();

            if (!$cek) {
                Role::create([
                    'name' => $role,
                ]);
            }
        }
    }
}
