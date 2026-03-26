<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();

        return view('admin.services.index', ['services' => $services]);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validar
        /*
            "name" => "Branding"
            "description" => "descr"
            "icon" => "algo"
            "sort_order" => "1"
            "is_active" => "1"
        */
        $validated = $request->validate([
            "name" => 'required|string|max:255',
            "description" => 'required|string|max:255',
            "icon" => 'required|string|max:255',
            "sort_order" => 'required|integer',
            "is_active" => 'required|boolean',
        ]);

        // Almacenar el servicio
        Service::create($validated);

        // Retornar a la vista.
        return redirect()->back()->with('success', 'Servicio creado correctamente');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            "name" => 'required|string|max:255',
            "description" => 'required|string|max:255',
            "icon" => 'required|string|max:255',
            "sort_order" => 'required|integer',
            "is_active" => 'required|boolean',
        ]);

        // Actualizar el servicio
        $service->update($validated);

        return redirect()->back()->with('success', 'Servicio actualizado correctamente');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->back()->with('success', 'Servicio eliminado correctamente');
    }

}
