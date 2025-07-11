<?php

namespace Database\Seeders;

use App\Models\header;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        header::create([
            'heading' => 'Selamat Datang di PT. Rayani Tata Bumi',
            'subheading' => 'Solusi Profesional untuk Survey dan Pemetaan',
            'description' => 'Kami adalah perusahaan yang bergerak di bidang survey pemetaan dan penyedia jasa pemetaan profesional untuk berbagai keperluan konstruksi dan pembangunan.',
        ]);
    }
}
