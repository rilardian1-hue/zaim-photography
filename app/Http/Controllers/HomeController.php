<?php

namespace App\Http\Controllers;

use App\Models\PhotographyWork;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestWorks = PhotographyWork::where('is_featured', true)->latest()->take(4)->get();
        $services = Service::where('is_active', true)->take(3)->get();
        
        return view('home.index', compact('latestWorks', 'services'));
    }
}
