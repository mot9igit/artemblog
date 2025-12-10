<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        "key",
        "name",
        "fias_id",
        "postal_code",
        "population",
        "active",
        "properties"
    ];

    public function regions(): hasMany {
        return $this->hasMany(Region::class);
    }
}
