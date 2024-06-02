<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Users Table';

    public function getHeaderWidgetsColumns(): int | array
    {
        return 3;
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            UserResource\Widgets\UserOverview::class,
        ];
    }

    

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
