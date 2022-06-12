<?php

namespace App\Enums;

enum Status: int
{
    case DRAFT = 0;
    case PUBLISHED = 1;
    case CORRECTION = 2;
    case HIDDEN = 3;

    public function getName(): string
    {
        return match($this) {
            self::DRAFT => 'Szkic',
            self::PUBLISHED => 'Opublikowany',
            self::CORRECTION => 'Do poprawy',
            self::HIDDEN => 'Ukryty',
            default => 'Status nieznany',
        };
    }
}
