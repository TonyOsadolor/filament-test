<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('ref_num')
                    ->label('Profile Reference'),
                Infolists\Components\TextEntry::make('surname'),
                Infolists\Components\TextEntry::make('first_name')
                    ->label('First Name'),
                Infolists\Components\TextEntry::make('middle_name')
                    ->label('Middle Name'),
                Infolists\Components\TextEntry::make('phone'),
                Infolists\Components\TextEntry::make('email'),
                Infolists\Components\TextEntry::make('user_type')
                    ->label('User Type'),
                Infolists\Components\TextEntry::make('is_admin')
                    ->label('Admin?')
                    ->formatStateUsing(function (User $user) {
                        if($user->is_admin === 1)
                        {return 'Yes';} return 'No';
                    }),
                Infolists\Components\TextEntry::make('admin_level')
                    ->label('Admin Level'),
                Infolists\Components\TextEntry::make('is_active')
                    ->label('Account Active?')
                    ->formatStateUsing(function (User $user) {
                        if($user->is_active === 1)
                        {return 'Yes';} return 'No';
                    }),
                Infolists\Components\TextEntry::make('updated_at')
                // Infolists\Components\TextEntry::make('notes')
                ->columnSpanFull(),
            ]);
    }
}
