<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        "key",
        "name",
        "fias_id",
        "postal_code",
        "population",
        "country_id",
        "active",
        "properties"
    ];

    public function cities(): hasMany {
        return $this->hasMany(City::class);
    }

    public function country(): belongsTo {
        return $this->belongsTo(Country::class);
    }
}
