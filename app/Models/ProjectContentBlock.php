<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectContentBlock extends Model
{
    protected $fillable = [
        'project_id',
        'type',
        'title',
        'content',
        'image_path',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'project_id' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}
