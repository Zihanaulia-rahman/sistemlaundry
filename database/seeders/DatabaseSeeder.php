<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Akun Admin
        User::create([
            'name'     => 'Administrator Laundry',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // 2. Akun Kasir
        User::create([
            'name'     => 'Kasir Laundry',
            'email'    => 'kasir@gmail.com',
            'password' => Hash::make('kasir123'),
            'role'     => 'kasir',
        ]);

        $this->call([
            LaundryItemSeeder::class,
        ]);
    }
}
