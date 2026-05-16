<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Request $request, Project $project): View
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        $relatedProjects = Project::whereHas('services', function($query) use ($project) {
            $query->whereIn('services.id', $project->services->pluck('id'));
        })
        ->where('id', '!=', $project->id)
        ->limit(5)
        ->get();

        $this->registerView($request, $project->id);

        return view('project', [
            'services' => $services,
            'project' => $project,
            'relatedProjects' => $relatedProjects
        ]);
    }

    private function registerView($request, $projectId): void
    {
        $sessionKey = "project_viewed_{$projectId}";

        if(! $request->session()->has($sessionKey)) {
            Project::whereKey($projectId)->increment('views_count');

            $request->session()->put($sessionKey, true);
        }
    }

}
