<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

        if (!$about) {
            $about = About::create([
                'title' => 'Sang Fotografer',
                'badge_text' => 'TENTANG',
                'full_name' => 'Zaim',
                'nickname' => 'Zaim',
                'school' => 'SMK Kartini Batam',
                'bio' => 'Nama saya Zaim, siswa dari SMK Kartini Batam. Saya mulai menyukai fotografi sejak duduk di bangku kelas 10, ketika saya menemukan keindahan dalam kontras cahaya dan bayangan. Sekolah saya di SMK Kartini Batam sangat mendukung saya untuk berkembang di bidang multimedia dan seni visual.',
                'profile_image' => 'https://picsum.photos/seed/zaim/800/800',
                'instagram_url' => 'https://instagram.com/zaim',
                'tiktok_url' => 'https://tiktok.com/@zaim',
                'flickr_url' => 'https://flickr.com/zaim',
                'experience' => 'Menjadi fotografer resmi acara tahunan SMK Kartini Batam, Juara 2 Lomba Fotografi Pelajar Kepri 2024.',
            ]);
        }

        return view('about.index', compact('about'));
    }
}
