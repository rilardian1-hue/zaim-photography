<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\PhotographyWork;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Zaim',
            'email' => 'admin@zaim.com',
            'password' => bcrypt('password123'),
        ]);

        About::create([
            'full_name' => 'Zaim',
            'nickname' => 'Zaim',
            'school' => 'SMK Kartini Batam',
            'bio' => 'Nama saya Zaim, siswa dari SMK Kartini Batam. Saya mulai menyukai fotografi sejak duduk di bangku kelas 10, ketika saya menemukan keindahan dalam kontras cahaya dan bayangan. Sekolah saya di SMK Kartini Batam sangat mendukung saya untuk berkembang di bidang multimedia dan seni visual.',
            'profile_image' => 'https://picsum.photos/seed/zaim/400/400?grayscale',
            'instagram_url' => 'https://instagram.com/zaim',
            'tiktok_url' => 'https://tiktok.com/@zaim',
            'flickr_url' => 'https://flickr.com/zaim',
            'experience' => 'Menjadi fotografer resmi acara tahunan SMK Kartini Batam, Juara 2 Lomba Fotografi Pelajar Kepri 2024.',
        ]);

        $services = [
            [
                'name' => 'Potrait Session',
                'slug' => Str::slug('Potrait Session'),
                'description' => 'Sesi foto personal untuk menangkap karakter sejatimu dalam balutan monokromatik.',
                'price' => 500000,
                'duration' => '3 Jam',
                'includes' => '1 Lokasi, 20 Edited Photos, All Original Files',
                'is_active' => true,
            ],
            [
                'name' => 'Wedding Documentation',
                'slug' => Str::slug('Wedding Documentation'),
                'description' => 'Merekam momen sakral dengan nuansa sinematik yang abadi.',
                'price' => 3500000,
                'duration' => 'Full Day (8 Jam)',
                'includes' => '2 Fotografer, 100 Edited Photos, Cetak Album Kolase, All Original Files',
                'is_active' => true,
            ],
            [
                'name' => 'Event Coverage',
                'slug' => Str::slug('Event Coverage'),
                'description' => 'Dokumentasi acara resmi, pensi, atau gathering dengan sudut pandang candid.',
                'price' => 1500000,
                'duration' => '4 Jam',
                'includes' => '1 Fotografer, 50 Edited Photos, Video Highlight 1 Menit',
                'is_active' => true,
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        $albums = [
            ['title' => 'Ethereal Shadows', 'slug' => Str::slug('Ethereal Shadows'), 'description' => 'Eksplorasi bayangan.'],
            ['title' => 'Urban Faces', 'slug' => Str::slug('Urban Faces'), 'description' => 'Potret jalanan kota.'],
        ];

        foreach ($albums as $album) {
            \App\Models\Album::create($album);
        }

        $categories = ['wedding', 'prewedding', 'potrait', 'event', 'commercial', 'street'];
        
        for ($i = 1; $i <= 12; $i++) {
            $cat = $categories[array_rand($categories)];
            PhotographyWork::create([
                'title' => 'Karya Monokrom ' . $i,
                'slug' => Str::slug('Karya Monokrom ' . $i . '-' . Str::random(5)),
                'description' => 'Sebuah eksplorasi cahaya dan bayangan pada subjek ' . $cat . '.',
                'image_path' => 'https://picsum.photos/seed/karya'.$i.'/800/1000?grayscale',
                'category' => $cat,
                'is_featured' => $i <= 4, // 4 karya pertama di-feature
                'shooting_date' => now()->subDays(rand(1, 100)),
                'album_id' => rand(1, 2)
            ]);
        }
    }
}
