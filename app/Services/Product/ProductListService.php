<?php

namespace App\Services\Product;

use App\Enums\Status;
use App\Http\Requests\Product\ProductListRequest;
use App\Models\Product;
use App\Orchid\Filters\ProductCategoryFilter;
use App\Orchid\Filters\ProductSearchFilter;
use App\Services\ConstService;
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
     * @param ProductListRequest $request
     *
     * @return LengthAwarePaginator
     */
    public function getList(ProductListRequest $request): LengthAwarePaginator
    {
        $perPage = $request->get('per_page', ConstService::DEFAULT_PER_PAGE);

        return $this->product->with([
            'categories'
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
