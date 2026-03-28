<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illumnate\Database\Eloquent\Relations\BelongsToMany;

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
        return $this->BelongsToMany(Service::class)->withTimestamps();
    }
}
