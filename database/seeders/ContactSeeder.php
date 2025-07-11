<?php

namespace Database\Seeders;

use App\Models\contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        contact::create([
            'location' => 'Jl. Raya Banjaran-Balamoa, Desa Kalikangkung, Kecamatan Pangkah, Kabupaten Tegal, Provinsi Jawa Tengah',
            'telephone' => '+62 21 1234 5678',
            'email' => 'info@rayani.co.id',
            'time_operational' => 'Senin - Jumat: 09.00 - 17.00 WIB',
        ]);
    }
}
