<?php

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class CategoryLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return iterable<Field>
     */
    protected function fields(): iterable
    {
        return [
            Group::make([
                Input::make('category.name')
                    ->title('Nazwa')
                    ->required(),
                CheckBox::make('category.active')
                    ->title('Ustawienia')
                    ->placeholder('Aktywna')
                    ->sendTrueOrFalse(),
            ]),
        ];
    }
}
