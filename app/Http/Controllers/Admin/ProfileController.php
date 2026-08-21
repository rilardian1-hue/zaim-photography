<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit()
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

        return view('admin.profile.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first();
        if (!$about) {
            $about = new About();
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:255',
            'full_name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'school' => 'required|string|max:255',
            'bio' => 'required|string',
            'experience' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'image_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'flickr_url' => 'nullable|url',
        ]);

        $data = [
            'title' => $request->filled('title') ? $request->title : 'Sang Fotografer',
            'badge_text' => $request->filled('badge_text') ? $request->badge_text : 'TENTANG',
            'full_name' => $request->full_name,
            'nickname' => $request->nickname ?? $request->full_name,
            'school' => $request->school,
            'bio' => $request->bio,
            'experience' => $request->experience,
            'instagram_url' => $request->instagram_url,
            'tiktok_url' => $request->tiktok_url,
            'flickr_url' => $request->flickr_url,
        ];

        if ($request->hasFile('image') || $request->filled('image_url')) {
            $newImage = $this->uploadImage($request);
            if (!empty($newImage)) {
                // Delete old local file if replacing
                if ($about->profile_image && Str::startsWith($about->profile_image, '/storage/')) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $about->profile_image));
                }
                $data['profile_image'] = $newImage;
            }
        }

        if ($about->exists) {
            $about->update($data);
        } else {
            $about->fill($data)->save();
        }

        return redirect()->route('admin.profile.edit')->with('success', 'Profil fotografer berhasil diperbarui!');
    }

    private function uploadImage(Request $request): string
    {
        if ($request->hasFile('image')) {
            try {
                $response = Http::asMultipart()
                    ->post('https://freeimage.host/api/1/upload', [
                        'key' => '6d207e02198a847aa98d0a2a901485a5',
                        'action' => 'upload',
                        'source' => base64_encode(file_get_contents($request->file('image')->getRealPath())),
                        'format' => 'json',
                    ]);

                if ($response->successful() && !empty($response->json()['image']['url'])) {
                    return $response->json()['image']['url'];
                }
            } catch (\Throwable $e) {
                // Fallback to local storage if external API fails
            }

            $local = $request->file('image')->store('profile', 'public');
            return '/storage/' . $local;
        }

        if ($request->filled('image_url')) {
            return $request->image_url;
        }

        return '';
    }
}
