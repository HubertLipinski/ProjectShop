<?php

namespace App\View\Composers;

use App\Services\Cart\UserCartService;
use Illuminate\View\View;

class CartCountComposer
{
    protected UserCartService $userCartService;

    public function __construct(UserCartService $userCartService)
    {
        $this->userCartService = $userCartService;
    }

    public function compose(View $view): void
    {
        $view->with('cartCount', $this->userCartService->items());
    }
}