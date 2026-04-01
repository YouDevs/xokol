<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;
use App\Models\Service;

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
    public function create(): View
    {
        $services = Service::all();
        return view('admin.projects.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        Project::create($data);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
