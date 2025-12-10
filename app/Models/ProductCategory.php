<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;
    use HasRecursiveRelationships;
    protected $table = 'product_categories';
    protected $guarded = false;

    public function getParentKeyName()
    {
        return 'parent_id';
    }

    public function getLocalKeyName()
    {
        return 'id';
    }
}
