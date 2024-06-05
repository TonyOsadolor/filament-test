<?php

namespace App\Filament\Resources\ProfileResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;
use App\Models\Profile;

class ProfileOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Created Profiles', Profile::count())
            ->description('Total Created Profiles')
            ->descriptionIcon('heroicon-m-user-circle', IconPosition::Before)
            ->color('success')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make('Uncompleted Profile', 
                Profile::where('completed', false)->count())
            ->description('Total Uncompleted')
            ->descriptionIcon('heroicon-m-user-circle', IconPosition::Before)
            ->color('info')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make('Completed Profile', 
                Profile::where('completed', true)->count())
            ->description('Total Completed')
            ->descriptionIcon('heroicon-m-user-circle', IconPosition::Before)
            ->color('warning')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
            Stat::make('Exam Passed', 
                Profile::where('passed_final_exam', true)->count())
            ->description(Profile::where('passed_final_exam',false)
                ->count().' Total Fail Exams')
            ->descriptionIcon('heroicon-m-user-circle', IconPosition::Before)
            ->color('danger')
            ->extraAttributes([
                'class' => 'cursor-pointer',
                'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
            ]),
        ];
    }
}
