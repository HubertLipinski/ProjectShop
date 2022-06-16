<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductListLayout;
use App\Services\ConstService;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ProductListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Product::with('categories')
                ->filters()
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
        return __('Produkty');
    }

    public function description(): ?string
    {
        return __('Lista wszystkich dostępnych produktów');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Dodaj'))
                ->icon('plus')
                ->route('platform.products.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ProductListLayout::class
        ];
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.products',
        ];
    }

    public function remove(Request $request): void
    {
        Product::findOrFail($request->get('id'))->delete();

        Toast::info('Produkt został usunięty');
    }
}
