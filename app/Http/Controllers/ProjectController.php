<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Project $project): View
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        $relatedProjects = Project::whereHas('services', function($query) use ($project) {
            $query->whereIn('services.id', $project->services->pluck('id'));
        })
        ->where('id', '!=', $project->id)
        ->limit(5)
        ->get();

        return view('project', [
            'services' => $services,
            'project' => $project,
            'relatedProjects' => $relatedProjects
        ]);
    }
}
