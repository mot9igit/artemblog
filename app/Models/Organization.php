<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "image",
        "address",
        "description",
        "bitrix_id",
        "active",
        "properties"
    ];

    public function requizites(): BelongsToMany{
        return $this->belongsToMany(Requizite::class);
    }

    public function stores(): BelongsToMany{
        return $this->belongsToMany(Store::class);
    }
}
