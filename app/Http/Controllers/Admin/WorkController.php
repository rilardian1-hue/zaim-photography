<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\PhotographyWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    public function index()
    {
        $works = PhotographyWork::with('album')->latest()->paginate(20);
        return view('admin.works.index', compact('works'));
    }

    public function create()
    {
        $albums = Album::all();
        $categories = PhotographyWork::select('category')->distinct()->pluck('category');
        return view('admin.works.create', compact('albums', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'image_url' => 'nullable|url',
            'album_id' => 'nullable|exists:albums,id',
            'shooting_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean'
        ]);

        if (!$request->hasFile('image') && !$request->filled('image_url')) {
            return back()->withErrors(['image' => 'Pilih file foto atau masukkan Link/URL foto.'])->withInput();
        }

        $imagePath = $this->uploadImage($request);

        PhotographyWork::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . Str::random(5)),
            'description' => $request->description,
            'image_path' => $imagePath,
            'category' => $request->category,
            'album_id' => $request->album_id,
            'shooting_date' => $request->shooting_date,
            'is_featured' => $request->has('is_featured')
        ]);

        return redirect()->route('admin.works.index')->with('success', 'Karya berhasil ditambahkan!');
    }

    public function edit(PhotographyWork $work)
    {
        $albums = Album::all();
        $categories = PhotographyWork::select('category')->distinct()->pluck('category');
        return view('admin.works.edit', compact('work', 'albums', 'categories'));
    }

    public function update(Request $request, PhotographyWork $work)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'image_url' => 'nullable|url',
            'album_id' => 'nullable|exists:albums,id',
            'shooting_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'album_id' => $request->album_id,
            'shooting_date' => $request->shooting_date,
            'is_featured' => $request->has('is_featured')
        ];

        if ($request->hasFile('image') || $request->filled('image_url')) {
            $data['image_path'] = $this->uploadImage($request);
        }

        $work->update($data);

        return redirect()->route('admin.works.index')->with('success', 'Karya berhasil diperbarui!');
    }

    private function uploadImage(Request $request): string
    {
        if ($request->hasFile('image')) {
            try {
                $response = \Illuminate\Support\Facades\Http::asMultipart()
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
                // Fallback to local storage if API fails
            }

            $local = $request->file('image')->store('works', 'public');
            return '/storage/' . $local;
        }

        if ($request->filled('image_url')) {
            return $request->image_url;
        }

        return '';
    }

    public function destroy(PhotographyWork $work)
    {
        if ($work->image_path && Str::startsWith($work->image_path, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $work->image_path));
        }
        $work->delete();
        return redirect()->route('admin.works.index')->with('success', 'Karya berhasil dihapus!');
    }
}
