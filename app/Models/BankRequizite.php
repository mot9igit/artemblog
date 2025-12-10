<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankRequizite extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "number",
        "knumber",
        "bik",
        "requizite_id",
        "properties"
    ];

    public function requizite(): belongsTo {
        return $this->belongsTo(Requizite::class);
    }
}
