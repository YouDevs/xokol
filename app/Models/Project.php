<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_carousel',
        'grid_image',
        'grid_image_size',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'views_count' => 'integer',
            'likes_count' => 'integer'
        ];
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function contentBlocks(): HasMany
    {
        return $this->hasMany(ProjectContentBlock::class)->orderBy('sort_order');
    }
}
