<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "name_short",
        "address",
        "description",
        "coordinats",
        "city_id",
        "active",
        "properties"
    ];

    public function organizations(): BelongsToMany{
        return $this->belongsToMany(Organization::class);
    }
}
