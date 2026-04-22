<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\Project;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $selectedService = $request['service'];

        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        $projectsQuery = Project::where('is_active', true);

        if ($selectedService) {
            $projectsQuery->whereHas('services', function($query) use ($selectedService) {
                $query->where('services.id', $selectedService);
            });
        }

        $projects = $projectsQuery->take(12)->get();

        return view('home', compact('services', 'projects', 'selectedService'));
    }
}
