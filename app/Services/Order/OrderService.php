<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Services\Cart\UserCartService;

class OrderService
{
    private UserCartService $userCartService;

    /**
     * @param UserCartService $userCartService
     */
    public function __construct(UserCartService $userCartService)
    {
        $this->userCartService = $userCartService;
    }

    /**
     * @param array $response
     *
     * @return Order
     */
    public function createOrder(array $response): Order
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_id' => $response['orderId'],
            'total' => $this->userCartService->total(),
            'items' => $this->userCartService->getCartItems(),
        ]);

        $this->userCartService->reset();

        return $order;
    }
}
