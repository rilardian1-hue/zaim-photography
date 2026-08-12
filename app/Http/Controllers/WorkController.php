<?php

namespace App\Http\Controllers;

use App\Models\PhotographyWork;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $query = PhotographyWork::query();

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $works = $query->latest()->paginate(12);
        $categories = PhotographyWork::select('category')->distinct()->pluck('category');

        if ($request->ajax()) {
            return view('works.partials.grid', compact('works'))->render();
        }

        return view('works.index', compact('works', 'categories'));
    }
}
