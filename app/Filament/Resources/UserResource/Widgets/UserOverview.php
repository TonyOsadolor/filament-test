<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;


class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Onboarded Users', User::count())
            ->description('Total Added Users')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->color('success')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make('Uncompleted Profile', 
                User::where('surname', null)->count())
            ->description('Total Uncompleted')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->color('info')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make('Total Admin', 
                User::where('user_type', 'admin')->count())
            ->description('Total Admin')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->color('warning')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make('Active Users', 
                User::where('is_active', true)->count())
            ->description(User::where('is_active',false)
                ->count().' Inactive Users')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->color('danger')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
        ];
    }
}
