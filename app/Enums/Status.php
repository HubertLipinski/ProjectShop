<?php

namespace App\Enums;

enum Status: int
{
    case NEW = 0;
    case PUBLISHED = 1;
    case CORRECTION = 2;
    case HIDDEN = 3;

    public function getName(): string
    {
        return match ($this) {
            self::NEW => 'Nowy',
            self::PUBLISHED => 'Opublikowany',
            self::CORRECTION => 'Do poprawy',
            self::HIDDEN => 'Ukryty',
            default => 'Status nieznany',
        };
    }

    public static function inputValues(): array
    {
        return collect(self::cases())
            ->transform(fn ($item) => [$item->value => $item->getName()])
            ->collapse()
            ->toArray();
    }

    public static function availableValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
