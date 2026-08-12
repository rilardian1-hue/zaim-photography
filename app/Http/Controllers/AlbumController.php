<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->get();
        return view('albums.index', compact('albums'));
    }

    public function show($slug)
    {
        $album = Album::where('slug', $slug)->firstOrFail();
        $works = $album->photographyWorks()->latest()->get();
        
        return view('albums.show', compact('album', 'works'));
    }
}
