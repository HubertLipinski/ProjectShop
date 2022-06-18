<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryListLayout;
use App\Services\ConstService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'categories' => Category::filters()
                ->defaultSort('id', 'desc')
                ->paginate(ConstService::DEFAULT_PER_PAGE),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Kategorie';
    }

    public function description(): ?string
    {
        return 'Lista wszystkich dostępnych kategorii';
    }

    /**
     * Button commands.
     *
     * @return iterable<\Orchid\Screen\Action>
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Dodaj'))
                ->icon('plus')
                ->route('platform.categories.create'),
        ];
    }

    /**
     * Views.
     *
     * @return array<\Orchid\Screen\Layout>|array<string>
     */
    public function layout(): iterable
    {
        return [
            CategoryListLayout::class,
        ];
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.categories',
        ];
    }
}
