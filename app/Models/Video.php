<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'description', 'video_source', 'external_url', 'video_file', 'thumbnail', 'duration', 'is_active', 'is_public', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get YouTube ID from external_url
     */
    public function getYoutubeIdAttribute()
    {
        if ($this->video_source !== 'youtube' || !$this->external_url) {
            return null;
        }

        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v=|v\/|embed\/|shorts\/))([\w-]{11})(?:[\?&].*)?$/", $this->external_url, $matches);
        
        return $matches[1] ?? null;
    }
}
