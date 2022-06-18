<?php

namespace App\Services\Payments;

abstract class BasePaymentService
{
    protected string $token = '';

    abstract public function getToken(): ?string;

    /**
     * @return string
     */
    final protected function token(): string
    {
        return $this->token;
    }

    /**
     * @return void
     */
    final protected function checkToken(): void
    {
        if (! $this->token) {
            $this->token = $this->getToken();
        }
    }
}
