<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;

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

        $sessionKey = "project_liked_{$project->id}";
        $alreadyLiked = $request->session()->get($sessionKey, false);

       [$titleMain, $titleAccent] = $this->splitTitle($project->title);


        return view('project', [
            'services' => $services,
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'alreadyLiked' => $alreadyLiked,
            'titleMain' => $titleMain,
            'titleAccent' => $titleAccent,
        ]);
    }

    public function registerLike(Request $request, Project $project): RedirectResponse
    {
        $sessionKey = "project_liked_{$project->id}";

        if (! $request->session()->get($sessionKey)) {
            $project->increment('likes_count');

            $request->session()->put($sessionKey, true);
        }

        return redirect()->route('project', $project);
    }

    private function registerView($request, $projectId): void
    {
        $sessionKey = "project_viewed_{$projectId}";

        if(! $request->session()->has($sessionKey)) {
            Project::whereKey($projectId)->increment('views_count');

            $request->session()->put($sessionKey, true);
        }
    }

    private function splitTitle($title): array
    {
        $parts = explode(' ', $title);

        if(count($parts) === 1) {
            $parts = [$parts[0], ''];
        }

        $accent = array_pop($parts);
        $main = implode(' ', $parts);

        return [$main, $accent];
    }

}
