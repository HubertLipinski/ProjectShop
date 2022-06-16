<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, SoftDeletes, AsSource, Filterable;

    protected $fillable = [
        'title',
        'description',
        'content',
        'price',
        'thumbnail',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    protected array $allowedFilters = [
        'title',
        'description',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];

    protected array $allowedSorts = [
        'id',
        'title',
        'description',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }
}
