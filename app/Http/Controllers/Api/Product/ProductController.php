<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductListService;
use Illuminate\Http\Request;

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
     * @param Request $request
     *
     * @return ProductCollection
     */
    public function index(Request $request): ProductCollection
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
