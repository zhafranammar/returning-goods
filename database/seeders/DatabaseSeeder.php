<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'password' => 'admin',
            'role' => 'superadmin',
            'email' => 'admin@admin.com',
        ]);

        \App\Models\Product::create([
            'code' => 'PROD-00000001',
            'name' => 'Kamus Saku Inggris Indonesia',
            'price' => 50000,
            'stock' => 500,
        ]);
        \App\Models\Product::create([
            'code' => 'PROD-00000002',
            'name' => 'Diary Book A5',
            'price' => 25000,
            'stock' => 300,
        ]);
        \App\Models\Product::create([
            'code' => 'PROD-00000003',
            'name' => 'Ensiklopedia Edisi 2018',
            'price' => 150000,
            'stock' => 80,
        ]);

        \App\Models\Supplier::create([
            'code' => 'SUPPLIER-00000001',
            'name' => 'PT Cetak Bersama',
            'email' => 'cetakbersama@mail.com',
            'contact_person' => '082222222222',
            'address' => 'Jl. Pepaya No. 17, Keluaran Belimbing, Kota Durian'
        ]);
        \App\Models\Supplier::create([
            'code' => 'SUPPLIER-00000002',
            'name' => 'CV Buku Laku',
            'email' => 'bukulaku@mail.com',
            'contact_person' => '085555555555',
            'address' => 'Jl. Nangka No. 17, Keluaran Apel, Kota Durian'
        ]);
    }
}
