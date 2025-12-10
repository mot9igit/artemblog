<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Requizite extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "ogrn",
        "inn",
        "kpp",
        "ur_address",
        "fact_address",
        "properties"
    ];

    public function organizations(): BelongsToMany{
        return $this->belongsToMany(Organization::class);
    }

    public function bankRequizites(): hasMany {
        return $this->hasMany(BankRequizite::class);
    }
}
