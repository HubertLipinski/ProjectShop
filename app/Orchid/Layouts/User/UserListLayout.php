<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'users';

    /**
     * @return array<TD>
     */
    public function columns(): array
    {
        return [
            TD::make('name', __('Nazwa'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (User $user) {
                    return new Persona($user->presenter());
                }),

            TD::make('email', __('Email'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (User $user) {
                    return ModalToggle::make($user->email)
                        ->modal('asyncEditUserModal')
                        ->modalTitle($user->presenter()->title())
                        ->method('saveUser')
                        ->asyncParameters([
                            'user' => $user->id,
                        ]);
                }),

            TD::make('updated_at', __('Ostatnio edytowany'))
                ->sort()
                ->render(function (User $user) {
                    return $user->updated_at->toDateTimeString();
                }),

            TD::make(__('Akcje'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (User $user) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edytuj'))
                                ->route('platform.systems.users.edit', $user->id)
                                ->icon('pencil'),

                            Button::make(__('Usuń'))
                                ->icon('trash')
                                ->confirm(__('Czy na pewno chcesz usunąć tego użytkownika?'))
                                ->method('remove', [
                                    'id' => $user->id,
                                ]),
                        ]);
                }),
        ];
    }
}
