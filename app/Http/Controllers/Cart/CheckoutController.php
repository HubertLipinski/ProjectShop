<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartCheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    private CartCheckoutService $cartCheckoutService;

    /**
     * @param CartCheckoutService $cartCheckoutService
     */
    public function __construct(CartCheckoutService $cartCheckoutService)
    {
        $this->cartCheckoutService = $cartCheckoutService;
    }

    /**
     * @return RedirectResponse
     */
    public function checkout(): RedirectResponse
    {
        $url = $this->cartCheckoutService->checkout();

        return redirect($url)->send();
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function orders(Request $request): View
    {
        $orders = auth()->user()->orders;

        if ($request->has('success')) {
            \Session::flash('success', 'Twoje zamówienie zostało pomyślnie złożone');
        }

        return view('cart.orders', compact('orders'));
    }
}
