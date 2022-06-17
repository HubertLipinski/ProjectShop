<?php

namespace App\Services\Payments\PayU;

use App\Services\Payments\BasePaymentService;
use Illuminate\Support\Facades\Http;

class PayuPaymentService extends BasePaymentService
{
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
     * @return string
     */
    public function sendRequest(): string
    {
        $this->checkToken();
        $response = Http::asJson()
            ->withToken($this->token)
            ->withOptions([
                'allow_redirects' => false,
            ])
            ->post(config('payment.payU.order_endpoint'), [
                'notifyUrl' => config('payment.payU.notify'),
                'continueUrl' => config('app.url') . '/payment-summary/payu?cart=' . auth()->id(),
                'customerIp' => request()->ip(),
                'merchantPosId' => config('payment.payU.pos_id'),
                'description' => 'Płatność PayU',
                'currencyCode' => 'PLN',
                'totalAmount' => 10 * 100,
                'settings' => [
                    'invoiceDisabled' => 'true'
                ],
                'products' => [ // todo
                    [
                        'name' => 'Produkt 1',
                        'unitPrice' => 15000,
                        'quantity' => 1
                    ]
                ]
            ]);

        if ($response->json('status.statusCode') === 'SUCCESS') {
            return $response->json('redirectUri');
        }

        abort(400, 'Wystąpił błąd podczas składania zamówienia');
    }
}
