<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'description', 'url', 'cover_image', 'banner_image', 'is_active', 'is_public', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_public' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
