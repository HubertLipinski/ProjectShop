<?php

namespace App\Enums;

enum OrderStatus: int
{
    case CREATED = 0;
    case PROCESSED = 1;

    public function getName(): string
    {
        return match ($this) {
            self::CREATED => 'Utworzony',
            self::PROCESSED => 'Przetworzony',
            default => 'Status nieznany',
        };
    }
}
