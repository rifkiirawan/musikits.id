<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'nama' => 'Iqbaal Pratama',
            'password' => Hash::make('admin'),
            'email' => 'iqbaalpratama@gmail.com',
            'no_hp' => '081234567890',
            'updated_at' => now(),
            'created_at' => now()
        ]);

    }
}
