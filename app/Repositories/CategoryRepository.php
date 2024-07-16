<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $category;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->category = new Category();
    }

    // 
    public function getAll()
    {
        return $this->category->with('categoryIcon')
            ->orderBy('created_at')
            ->get();
    }
}
