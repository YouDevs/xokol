<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectService
{

    public function update(UpdateProjectRequest $request, Project $project): void
    {
        $projectData = $request->validated(); // projects y project_content_blocks

        $serviceIds = $projectData['service_ids'] ?? []; // project_service

        $this->syncProjectContentBlocks($project, $projectData);

        unset(
            $projectData['service_ids'],
            $projectData['block_content_types'],
            $projectData['block_titles'],
            $projectData['block_contents'],
            $projectData['block_images'],
        );

        // Reemplazar-Actualizar imagenes
        if ($request->hasFile('image_carousel')) {
            if ($project->image_carousel) {
                Storage::disk('public')->delete($project->image_carousel);
            }
            $projectData['image_carousel'] = $request->file('image_carousel')->store('projects/carousel', 'public');
        }

        if ($request->hasFile('grid_image')) {
            if ($project->grid_image) {
                Storage::disk('public')->delete($project->grid_image);
            }
            $projectData['grid_image'] = $request->file('grid_image')->store('projects/grid', 'public');
        }

        // actualizamos el proyecto en la BD.
        $project->update($projectData);

        // sincronizamos servicios relacionados.
        $project->services()->sync($serviceIds);

    }


    private function syncProjectContentBlocks(Project $project, array $data):void
    {
        Log::info('Project content payload', [
            'project_id' => $project->id,
            'block_content_types' => $data['block_content_types'] ?? [],
            'block_titles' => $data['block_titles'] ?? [],
            'block_contents' => $data['block_contents'] ?? [],
            'block_images' => $data['block_images'] ?? [],
        ]);
    }

}
