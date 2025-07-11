<?php

namespace Database\Seeders;

use App\Models\social;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        social::create([
            'facebook'  => 'https://facebook.com/yourpage',
            'youtube'   => 'https://youtube.com/yourchannel',
            'linkedin'  => 'https://linkedin.com/in/yourprofile',
            'whatsapp'  => 'https://wa.me/6281234567890',
            'instagram' => 'https://instagram.com/yourprofile',
        ]);
    }
}
