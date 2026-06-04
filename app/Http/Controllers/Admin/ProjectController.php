<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;
use App\Models\Service;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\ProjectService;

class ProjectController extends Controller
{

    public function __construct(private ProjectService $projectService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $projects = Project::all();
        return view('admin.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $services = Service::all();
        return view('admin.projects.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image_carousel'] = $request->file('image_carousel')->store('projects/carousel', 'public');
        $data['grid_image'] = $request->file('grid_image')->store('projects/grid', 'public');

        $project = Project::create($data);
        $project->services()->sync($data['service_ids']);

        return redirect()->route('admin.projects.index')->with('success', 'Proyecto Creado Exitosamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        $services = Service::all();

        $project->load('services', 'contentBlocks');

        return view('admin.projects.edit', [
            'services' => $services,
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->projectService->update($request, $project);

        return redirect()->route('admin.projects.index')->with('success', 'Proyecto Actualizado Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Eliminar imagenes
        if ($project->image_carousel) {
            Storage::disk('public')->delete($project->image_carousel);
        }

        if ($project->grid_image) {
            Storage::disk('public')->delete($project->grid_image);
        }

        // Desvincular servicios
        $project->services()->detach();

        // Eliminar proyecto:
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyecto Eliminado Exitosamente');

    }
}
