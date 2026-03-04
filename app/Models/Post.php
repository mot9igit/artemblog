<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'title',
        'slug',
        'introtext',
        'content',
        'image',
        'published',
        'published_at',
        'user_id'
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function author(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getImageUrlAttribute(): ?string{ // image_url attribute
        return $this->image ? asset('storage/'. $this->image) : null;
    }
}
