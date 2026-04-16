<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        $projects = Project::where('is_active', true)
                        ->orderBy('is_featured')
                        ->orderByDesc('published_at')
                        ->orderByDesc('id')
                        ->take(12)
                        ->get();

        return view('home', compact('services', 'projects'));
    }
}
