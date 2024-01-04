<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    private Category $category;

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->category->active()->get();
    }
}
