<?php

namespace App\Services\Cart;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserCartService
{
    public const CART_KEY = 'user_{{id}}_cart';

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
     * @return void
     */
    public function addToCart(Request $request): void
    {
        $product = $this->product->findOrFail($request->get('id'));

        session()->push($this->getSessionKey(), $product);
    }

    /**
     * @return Collection
     */
    public function getCartItems(): Collection
    {
        $items = collect(session()->get($this->getSessionKey()));

        $existingProducts = $this->product->whereIn('id', $items->pluck('id')->toArray())->get();

        return collect($existingProducts);
    }

    /**
     * @param Product $product
     *
     * @return void
     */
    public function removeFromCart(Product $product): void
    {
        $items = $this->getCartItems()
            ->reject(fn (Product $cartProduct) => $product->id === $cartProduct->id);

        session()->put($this->getSessionKey(), $items);
    }

    /**
     * @return float
     */
    public function total(): float
    {
        return $this->getCartItems()
            ->sum('price');
    }

    /**
     * @return int
     */
    public function items(): int
    {
        return $this->getCartItems()
            ->count();
    }

    public function reset(): void
    {
        session()->forget($this->getSessionKey());
    }

    /**
     * @return string
     */
    private function getSessionKey(): string
    {
        return str_replace('{{id}}', auth()->id(), self::CART_KEY);
    }
}
