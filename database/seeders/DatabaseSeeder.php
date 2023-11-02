<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ListPelanggaran;
use App\Models\Siswa;
use App\Models\Aksi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            JurusanSeeder::class,
            KelasSeeder::class,
            GuruBKSeeder::class,
            PelanggaranSeeder::class
        ]);

        Siswa::factory(100)->create();
        Aksi::factory(30)->create();
        ListPelanggaran::factory(95)->create();
    }
}
