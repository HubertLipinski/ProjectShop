<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\Payments\PayU\PayuPaymentService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private PayuPaymentService $payuPaymentService;

    /**
     * @param PayuPaymentService $payuPaymentService
     */
    public function __construct(PayuPaymentService $payuPaymentService)
    {
        $this->payuPaymentService = $payuPaymentService;
    }

    public function checkout()
    {
        // todo checkout

        $response = $this->payuPaymentService->sendRequest();

        dd($response);

        dd($this->payuPaymentService->getToken());
    }
}
