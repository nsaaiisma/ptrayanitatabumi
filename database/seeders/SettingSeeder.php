<?php

namespace Database\Seeders;

use App\Models\title;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        title::create([
            'captionProduct' => 'Produk Unggulan Kami',
            'descriptionProduct' => 'Temukan berbagai jenis properti berkualitas tinggi untuk berbagai kebutuhan Anda.',
            'captionPortofolio' => 'Portofolio Pekerjaan',
            'descriptionPortofolio' => 'Proyek-proyek yang telah kami selesaikan dengan sempurna.',
            'captionAboutMe' => 'Perjalanan Kami',
            'descriptionAboutMe' => 'Sejak berdiri di tahun 2010, kami telah tumbuh menjadi salah satu pengembang properti terkemuka di Indonesia. Dengan komitmen terhadap kualitas dan inovasi, kami terus menghadirkan solusi properti terbaik untuk berbagai kebutuhan.',
            'captionTestimoni' => 'Apa Kata Mereka',
            'descriptionTestimoni' => 'Testimoni dari klien dan mitra kami.',
        ]);
    }
}
