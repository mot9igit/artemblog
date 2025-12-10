<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        "key",
        "name",
        "name_r",
        "fias_id",
        "postal_code",
        "population",
        "region_id",
        "active",
        "properties"
    ];

    public function country(): belongsTo {
        return $this->belongsTo(Region::class);
    }
}
