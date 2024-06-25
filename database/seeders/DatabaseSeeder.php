<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Prodi::create([
            'nama_prodi' => 'Bisnis Digital'
        ]);

        Prodi::create([
            'nama_prodi' => 'Manajemen Informatika'
        ]);

        prodi::factory(10)->create();

        Mahasiswa::create([
            'nim' => 'E123123',
            'nama' => 'Effan',
            'no_hp' => '085221078887',
            'alamat' => 'Benua Anyar',
            'foto' => 'effan.jpg',
            'prodi_id' => 1,
        ]);

        Mahasiswa::create([
            'nim' => 'E123124',
            'nama' => 'Najwaini',
            'no_hp' => '123',
            'alamat' => 'Benua Anyar',
            'foto' => 'effan.jpg',
            'prodi_id' => 2,
        ]);

        User::create([
            'user' => 'Admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'user' => 'E123123',
            'password' => bcrypt('E123123'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'user' => 'E123124',
            'password' => bcrypt('E123124'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::factory(10)->create();
    }
}
