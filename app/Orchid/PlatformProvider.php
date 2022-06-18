<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return array<Menu>
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Wróć do sklepu')
                ->icon('action-undo')
                ->route('products.index'),

            Menu::make(__('Produkty'))
                ->icon('list')
                ->route('platform.products.list')
                ->permission('platform.systems.products')
                ->title('Zarządzanie produktami'),

            Menu::make(__('Kategorie'))
                ->icon('tag')
                ->route('platform.categories.list')
                ->permission('platform.systems.categories'),

            Menu::make(__('Użytkownicy'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Zarządzanie użytkownikami')),

            Menu::make(__('Role'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return array<Menu>
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Mój profil')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return array<ItemPermission>
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Role'))
                ->addPermission('platform.systems.users', __('Użytkownicy'))
                ->addPermission('platform.systems.products', __('Produkty'))
                ->addPermission('platform.systems.categories', __('Kategorie')),

            ItemPermission::group(__('Produkty'))
                ->addPermission('platform.products.create', __('Tworzenie'))
                ->addPermission('platform.products.update', __('Aktualizacja'))
                ->addPermission('platform.products.delete', __('Usuwanie')),

            ItemPermission::group(__('Kategorie'))
                ->addPermission('platform.categories.create', __('Tworzenie'))
                ->addPermission('platform.categories.update', __('Aktualizacja'))
                ->addPermission('platform.categories.delete', __('Usuwanie')),
        ];
    }
}
