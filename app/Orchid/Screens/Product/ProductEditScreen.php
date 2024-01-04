<?php

namespace App\Orchid\Screens\Product;

use App\Enums\Status;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    public Product $product;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        $product->load('categories');

        return [
            'product' => $product,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->product->exists ? __('Edytuj Produkt') : __('Dodaj nowy produkt');
    }

    /**
     * Button commands.
     *
     * @return iterable<\Orchid\Screen\Action>
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Dodaj')
                ->method('createOrUpdate')
                ->icon('check')
                ->class('btn py-2 px-4')
                ->canSee(! $this->product->exists),

            Button::make('Aktualizuj')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->product->exists),

            Button::make('Usuń')
                ->icon('trash')
                ->method('remove')
                ->confirm('Czy na pewno chcesz usunąć produkt?')
                ->canSee($this->product->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::columns([
                Layout::rows([
                    Input::make('product.title')
                        ->title('Tytuł'),
                    Input::make('product.price')
                        ->title('Cena produktu')
                        ->type('text')
                        ->mask([
                            'alias' => 'currency',
                            'prefix' => '',
                            'groupSeparator' => '',
                            'digitsOptional' => false,
                        ]),
                    TextArea::make('product.description')
                        ->title('Opis produktu')
                        ->rows(2),
                    Select::make('status')
                        ->options(Status::inputValues())
                        ->title('Status'),
                    Relation::make('product.categories.')
                        ->title('Kategorie')
                        ->fromModel(Category::class, 'name')
                        ->applyScope('active')
                        ->multiple(),
                    Quill::make('product.content')
                        ->title('Sczegółowy opis produktu')
                        ->height('200px'),
                ]),
            ]),
            Layout::columns([
                Layout::rows([
                    Cropper::make('product.thumbnail')
                        ->title('Miniaturka')
                        ->storage(env('APP_ENV') !== 'local' ? 's3' : 'public'),
                ]),
            ]),
        ];
    }

    public function createOrUpdate(Product $product, ProductStoreRequest $request): RedirectResponse
    {
        $data = $request->get('product');
        $data['status'] = $request->get('status');

        $product->fill($data)->save();

        $product->categories()->syncWithoutDetaching($request->input('product.categories', []));

        Alert::info('Produkt został pomyślnie ' . ($product->wasRecentlyCreated ? 'utworzony' : 'zaktualizowany') . '.');

        return redirect()->route('platform.products.list');
    }

    public function remove(Product $product): RedirectResponse
    {
        $product->delete();

        Alert::info('Produkt został pomyślnie usunięty.');

        return redirect()->route('platform.products.list');
    }
}
