<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->get();
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Album::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . Str::random(5)),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dibuat!');
    }

    public function edit(Album $album)
    {
        $works = \App\Models\PhotographyWork::latest()->get();
        return view('admin.albums.edit', compact('album', 'works'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'works' => 'nullable|array',
            'works.*' => 'exists:photography_works,id'
        ]);

        $album->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Reset old works in this album to null
        \App\Models\PhotographyWork::where('album_id', $album->id)->update(['album_id' => null]);
        
        // Assign new works
        if ($request->has('works')) {
            \App\Models\PhotographyWork::whereIn('id', $request->works)->update(['album_id' => $album->id]);
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil diperbarui!');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dihapus!');
    }

    public function generateDescription(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $title = $request->title;
        $prompt = "Buat paragraf deskripsi yang puitis, profesional, dan SEO-friendly untuk album foto dengan judul/tema: '$title'. Jangan terlalu panjang, maksimal 3 kalimat. Gunakan bahasa Indonesia yang elegan.";

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => 'Bearer REMOVED_SECRET',
                'Content-Type' => 'application/json',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'google/gemini-flash-1.5',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $description = $result['choices'][0]['message']['content'] ?? '';
                return response()->json(['success' => true, 'description' => trim($description)]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal menghubungi AI. '. $response->body()], 500);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
