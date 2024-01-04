<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Cart\UserCartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    private UserCartService $userCartService;

    /**
     * @param UserCartService $userCartService
     */
    public function __construct(UserCartService $userCartService)
    {
        $this->userCartService = $userCartService;
    }

    public function index(): View
    {
        $items = $this->userCartService->getCartItems();
        $total = $this->userCartService->total();

        return view('cart.index', compact('items', 'total'));
    }

    public function store(Request $request): JsonResponse
    {
        $this->userCartService->addToCart($request);

        return response()->json(['status' => true]);
    }

    public function delete(Product $product): RedirectResponse
    {
        $this->userCartService->removeFromCart($product);

        return redirect()->back()->with('success', 'Pomyslnie usunięto przedmiot z koszyka');
    }
}
