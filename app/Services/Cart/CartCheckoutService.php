<?php

namespace App\Services\Cart;

use App\Services\Order\OrderService;
use App\Services\Payments\PayU\PayuPaymentService;

class CartCheckoutService
{
    private PayuPaymentService $payuPaymentService;
    private OrderService $orderService;

    /**
     * @param PayuPaymentService $payuPaymentService
     * @param OrderService $orderService
     */
    public function __construct(PayuPaymentService $payuPaymentService, OrderService $orderService)
    {
        $this->payuPaymentService = $payuPaymentService;
        $this->orderService = $orderService;
    }

    /**
     * @return string
     */
    public function checkout(): string
    {
        $details = $this->payuPaymentService->sendRequest();
        $this->orderService->createOrder($details);

        return $details['redirectUri'];
    }
}
