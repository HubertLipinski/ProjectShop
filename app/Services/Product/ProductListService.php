<?php

namespace App\Services\Product;

use App\Enums\Status;
use App\Models\Product;
use App\Orchid\Filters\ProductCategoryFilter;
use App\Orchid\Filters\ProductSearchFilter;
use App\Services\ConstService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductListService
{
    private Product $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function getList(Request $request): LengthAwarePaginator
    {
        $perPage = $request->get('per_page', ConstService::DEFAULT_PER_PAGE);

        return $this->product->with([
            'categories',
        ])
            ->where('status', '=', Status::PUBLISHED)
            ->filters()
            ->filtersApply([
                ProductCategoryFilter::class,
                ProductSearchFilter::class,
            ])
            ->defaultSort('id', 'desc')
            ->paginate($perPage);
    }
}
