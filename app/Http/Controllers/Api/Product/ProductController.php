<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductListRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductListService;

class ProductController extends Controller
{
    private ProductListService $productListService;

    /**
     * @param ProductListService $productListService
     */
    public function __construct(ProductListService $productListService)
    {
        $this->productListService = $productListService;
    }

    /**
     * @param ProductListRequest $request
     *
     * @return ProductCollection
     */
    public function index(ProductListRequest $request): ProductCollection
    {
        $list = $this->productListService->getList($request);

        return new ProductCollection($list);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        $product = Product::findOrFail($id);

        return new ProductResource($product);
    }
}
