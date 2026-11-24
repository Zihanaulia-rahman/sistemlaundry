<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaundryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan data lama terlebih dahulu agar id dan data sesuai standar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('laundry_items')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('laundry_items')->insert([
            [
                'id'          => 1,
                'name'        => 'Reguler',
                'category'    => 'cuci',
                'price'       => 7000,
                'description' => 'Layanan cuci reguler bersih dan wangi (estimasi 2-3 hari).',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 2,
                'name'        => 'Ekspres',
                'category'    => 'cuci',
                'price'       => 12000,
                'description' => 'Layanan cuci cepat selesai dalam 24 jam.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => 3,
                'name'        => 'Superkilat',
                'category'    => 'paket',
                'price'       => 25000,
                'description' => 'Layanan cuci prioritas supercepat selesai dalam kurun waktu 3-5 jam.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
