<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "title" => 'required|string|max:255',
            "description" => 'required|string|max:255',
            'image_carousel' => 'required|image|max:5120',
            'grid_image' => 'required|image|max:5120',
            "grid_image_size" => 'integer',
            "is_active" => 'boolean',
            "service_ids" => 'nullable|array',
            'service_ids.*' => 'integer|exists:services,id'
        ]);

        $data = $validated;

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

        $project->load('services');

        return view('admin.projects.edit', [
            'services' => $services,
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            "title" => 'required|string|max:255',
            "description" => 'required|string|max:255',
            'image_carousel' => 'nullable|image|max:5120',
            'grid_image' => 'nullable|image|max:5120',
            "grid_image_size" => 'integer',
            "is_active" => 'boolean',
            "service_ids" => 'nullable|array',
            'service_ids.*' => 'integer|exists:services,id'
        ]);

        $data = $validated;

        // reemplazar imagenes si llegaron nuevas.
        if ($request->hasFile('image_carousel')) {
            if ($project->image_carousel) {
                Storage::disk('public')->delete($project->image_carousel);
            }
            $data['image_carousel'] = $request->file('image_carousel')->store('projects/carousel', 'public');
        }

        if ($request->hasFile('grid_image')) {
            if ($project->grid_image) {
                Storage::disk('public')->delete($project->grid_image);
            }
            $data['grid_image'] = $request->file('grid_image')->store('projects/grid', 'public');
        }

        // actualizamos el proyecto en la BD.
        $project->update($data);

        // sincronizamos servicios relacionados.
        $project->services()->sync($data['service_ids']);

        return redirect()->route('admin.projects.index')->with('success', 'Proyecto Actualizado Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
