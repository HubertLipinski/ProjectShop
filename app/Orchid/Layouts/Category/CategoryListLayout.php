<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return iterable<TD>
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')
                ->sort(),
            TD::make('name', 'Nazwa')
                ->sort()
                ->render(fn (Category $category) => Link::make($category->name)->route('platform.categories.edit', $category)),
            TD::make('active', 'Aktywna')
                ->sort()
                ->filter(TD::FILTER_SELECT, [true => 'Tak', false => 'Nie'])
                ->render(fn (Category $category) => $category->active ? 'Tak' : 'Nie'),
        ];
    }
}
