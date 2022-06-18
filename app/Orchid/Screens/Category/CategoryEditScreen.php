<?php

namespace App\Orchid\Screens\Category;

use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Orchid\Layouts\Category\CategoryLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoryEditScreen extends Screen
{
    public Category $category;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        return [
            'category' => $category,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return ($this->category->exists ? 'Edytuj' : 'Dodaj nową') . ' kategorię';
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
                ->canSee(! $this->category->exists),

            Button::make('Aktualizuj')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->category->exists),

            Button::make('Usuń')
                ->icon('trash')
                ->method('remove')
                ->confirm('Czy na pewno chcesz usunąć kategorie?')
                ->canSee($this->category->exists),
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
            Layout::columns([
                CategoryLayout::class,
            ]),
        ];
    }

    public function createOrUpdate(Category $category, CategoryUpdateRequest $request): RedirectResponse
    {
        $category->fill($request->get('category'))->save();

        Alert::info('Kategoria została pomyślnie '.($category->wasRecentlyCreated ? 'utworzona' : 'zaktualizowana').'.');

        return redirect()->route('platform.categories.list');
    }

    public function remove(Category $category): RedirectResponse
    {
        $category->delete();

        Toast::info('Kategoria została usunięta');

        return redirect()->route('platform.categories.list');
    }
}
