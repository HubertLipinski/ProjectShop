<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Panel Admina';
    }

    /**
     * Button commands.
     *
     * @return iterable<\Orchid\Screen\Action>
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('GitHub')
                ->href('https://github.com/HubertLipinski/ProjectShop')
                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return iterable<\Orchid\Screen\Layout>
     */
    public function layout(): iterable
    {
        return [
        ];
    }
}
