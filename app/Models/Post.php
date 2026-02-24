<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'image',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getExcerptPreviewAttribute(): string
    {
        return $this->excerpt ?: Str::limit(strip_tags($this->content), 150);
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->is_published ? 'Published' : 'Draft';
    }
}
