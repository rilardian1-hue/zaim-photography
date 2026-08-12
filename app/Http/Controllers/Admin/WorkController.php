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
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'album_id' => 'nullable|exists:albums,id',
            'shooting_date' => 'nullable|date',
            'is_featured' => 'nullable|boolean'
        ]);

        $imagePath = $request->file('image')->store('works', 'public');

        PhotographyWork::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . Str::random(5)),
            'description' => $request->description,
            'image_path' => '/storage/' . $imagePath,
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
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

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($work->image_path && Str::startsWith($work->image_path, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $work->image_path));
            }
            $imagePath = $request->file('image')->store('works', 'public');
            $data['image_path'] = '/storage/' . $imagePath;
        }

        $work->update($data);

        return redirect()->route('admin.works.index')->with('success', 'Karya berhasil diperbarui!');
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
