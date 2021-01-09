<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatMusikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO `alat` (`id`, `nama_alat`, `harga_sewa`, `status_barang`, `gambar`, `id_admin`, `created_at`, `updated_at`) VALUES
        (NULL, 'Hi-hat + Stand', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Cymbal 16 + Stand', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Cymbal 14 + Stand ', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Ride 18 + Stand', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Snare 14 + Stand', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Tom 12', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Tom 13', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Floor 16', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Bass Drum 22', '20000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Bass 4 Senar', '80000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Keyboard Roland Hitam', '80000', 'Rusak', '', NULL, NOW(), NOW()),
        (NULL, 'Kabel Power', '10000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Gitar Listrik', '80000', 'Rusak', '', NULL, NOW(), NOW()),
        (NULL, 'Gitar Akustik Hitam', '70000', 'Rusak', '', NULL, NOW(), NOW()),
        (NULL, 'Gitar Akustik Coklat', '90000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Amplifier Besar', '150000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Amplifier Fender', '200000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Microphone', '50000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Kabel Jack 1/4', '10000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Cajoon', '50000', 'Baik', '', NULL, NOW(), NOW()),
        (NULL, 'Stand Microphone', '10000', 'Baik', '', NULL, NOW(), NOW());");
    }
}
