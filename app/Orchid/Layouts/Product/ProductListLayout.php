<?php

namespace App\Orchid\Layouts\Product;

use App\Enums\Status;
use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return iterable<TD>
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')
                ->sort()
                ->width('150')
                ->render(function (Product $product) {
                    $url = $product->thumbnail;

                    return "<img src='${url}' class='mw-100 d-block img-fluid' alt='product thumbnal'>
                            <span class='small text-muted mt-1 mb-0'># {$product->id}</span>";
                }),
            TD::make('title', 'Tytuł')
                ->sort()
                ->filter(Input::make())->render(fn (Product $product) => Link::make($product->title)->route('platform.products.edit', $product->id)),
            TD::make('price', 'Cena')
                ->sort()
                ->filter(Input::make()),
            TD::make('status', 'Status')
                ->sort()
                ->filter(TD::FILTER_SELECT, Status::inputValues())
                ->render(fn (Product $product) => $product->status->getName()),
            TD::make('created_at', 'Dodano')
                ->sort()
                ->render(fn (Product $product) => $product->created_at->toDateTimeString()),
            TD::make('updated_at', 'Zaktualizowano')
                ->sort()
                ->render(fn (Product $product) => $product->updated_at->toDateTimeString()),
            TD::make(__('Akcje'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Product $product) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edytuj'))
                                ->route('platform.products.edit', $product->id)
                                ->icon('pencil'),

                            Button::make(__('Usuń'))
                                ->icon('trash')
                                ->confirm(__('Czy na pewno chcesz usunąć ten produkt?'))
                                ->method('remove', [
                                    'id' => $product->id,
                                ]),
                        ]);
                }),
        ];
    }
}
