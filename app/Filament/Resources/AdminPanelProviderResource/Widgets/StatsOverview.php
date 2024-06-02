<?php

namespace App\Filament\Resources\AdminPanelProviderResource\Widgets;

use App\Models\Course;
use App\Models\Profile;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;

class StatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            Stat::make('Onboarded Users', User::count())
            ->description('Users of the Application')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->color('success')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                'href' => 'https://google.com',
            ]),
            Stat::make('Profiles', Profile::count())
                ->description('Total Profiles')
                ->descriptionIcon('heroicon-m-user-circle', IconPosition::Before)
                ->color('info')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make('Course', Course::count())
                ->description('Total Course Available')
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
                ->color('warning')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
        ];
    }
}
