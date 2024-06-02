<?php

namespace App\Filament\Resources\ProfileResource\Pages;

use App\Filament\Resources\ProfileResource;
use App\Models\Profile;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Actions;

class ViewProfile extends ViewRecord
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('user.surname')
                    ->label('Surname'),
                Infolists\Components\TextEntry::make('user.first_name')
                    ->label('First Name'),
                Infolists\Components\TextEntry::make('user.middle_name')
                    ->label('Middle Name'),
                Infolists\Components\TextEntry::make('user.phone')
                    ->label('Phone'),
                Infolists\Components\TextEntry::make('user.email')
                    ->label('Email'),
                Infolists\Components\TextEntry::make('dept')
                    ->label('Department'),
                Infolists\Components\TextEntry::make('entry_year')
                    ->label('Entry Year'),
                Infolists\Components\TextEntry::make('graduation_year'),
                Infolists\Components\TextEntry::make('approval_date'),
                Infolists\Components\TextEntry::make('passed_final_exam'),
                Infolists\Components\TextEntry::make('is_completed')
                    ->label('Completed?')
                    ->formatStateUsing(function (Profile $profile) {
                        if($profile->is_completed === true)
                        {return 'Yes';} return 'No';
                    }),
                Infolists\Components\TextEntry::make('updated_at')
                // Infolists\Components\TextEntry::make('notes')
                ->columnSpanFull(),
            ]);
    }
}
