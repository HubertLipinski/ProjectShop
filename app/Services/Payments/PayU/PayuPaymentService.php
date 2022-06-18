<?php

namespace App\Services\Payments\PayU;

use App\Services\Cart\UserCartService;
use App\Services\Payments\BasePaymentService;
use Illuminate\Support\Facades\Http;

class PayuPaymentService extends BasePaymentService
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
     * @return string
     */
    public function getToken(): string
    {
        $response = Http::asForm()
            ->post(config('payment.payU.oauth_endpoint'), [
                'grant_type' => 'client_credentials',
                'client_id' => config('payment.payU.client_id'),
                'client_secret' => config('payment.payU.client_secret'),
            ]);

        if ($response->ok()) {
            return $response->collect()->get('access_token');
        }

        abort(400, 'Wystąpił błąd podczas pobierania tokenu PayU');
    }

    /**
     * @return array
     */
    public function sendRequest(): array
    {
        $this->checkToken();
        $response = Http::asJson()
            ->withToken($this->token)
            ->withOptions([
                'allow_redirects' => false,
            ])
            ->post(config('payment.payU.order_endpoint'), [
                'notifyUrl' => config('payment.payU.notify'),
                'continueUrl' => route('payment.orders') . '?success=true',
                'customerIp' => request()->ip(),
                'merchantPosId' => config('payment.payU.pos_id'),
                'description' => 'Płatność PayU',
                'currencyCode' => 'PLN',
                'totalAmount' => $this->userCartService->total() * 100,
                'settings' => [
                    'invoiceDisabled' => 'true',
                ],
            ]);

        if ($response->json('status.statusCode') === 'SUCCESS') {
            return $response->json();
        }

        abort(400, 'Wystąpił błąd podczas składania zamówienia');
    }
}
