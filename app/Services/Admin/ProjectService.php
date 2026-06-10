<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProjectService
{

    public function update(UpdateProjectRequest $request, Project $project): void
    {
        // dd($request->validated());
        $projectData = $request->validated();

        $serviceIds = $projectData['service_ids'] ?? [];

        $this->syncProjectContentBlocks($request, $project, $projectData);

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


    private function syncProjectContentBlocks(UpdateProjectRequest $request, Project $project, array $data):void
    {
        $contentTypes = $data['block_content_types'] ?? [];
        $titles = $data['block_titles'] ?? [];
        $contents = $data['block_contents'] ?? [];
        $images = $data['block_images'] ?? [];

        $blocks = [];

        foreach($contentTypes as $index => $contentType) {
            if (blank($contentType)) {
                continue;
            }

            $title = $titles[$index] ?? '';
            $content = $contents[$index] ?? '';
            $image_path = '';

            if ($contentType == 'image_path') {

                $current = $project->contentBlocks()
                    ->where('type', 'image_path')
                    ->where('sort_order', $index + 1)
                    ->first();

                if ($request->hasFile("block_images.$index")) {
                    $current?->image_path && Storage::disk('public')->delete($current->image_path);
                    
                    $image_path = $request->file("block_images.$index")->store('projects/blocks', 'public');
                }
                else {
                    $image_path = $current?->image_path ?? '';
                }

            }

            $blocks[] = [
                'type' => $contentType,
                'title' => $title,
                'content' => $content,
                'image_path' => $image_path,
                'sort_order' => count($blocks) + 1,
            ];
        }

        $project->contentBlocks()->delete();

        $project->contentBlocks()->createMany($blocks);

    }

}
