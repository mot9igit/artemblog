<?php

namespace App\Services\ProductCategory;

use App\Models\ProductCategory;

class Service
{
    public function store($data){
        $category = ProductCategory::firstOrCreate($data);
        return $category;
    }

    public function update($category, $data){
        $category = $category->update($data);
        return $category;
    }
}
