<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
use App\Traits\ResourceMasksRecordId;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfileResource extends Resource
{
    use ResourceMasksRecordId;

    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.surname')
                    ->label('surname'),
                Tables\Columns\TextColumn::make('user.first_name')
                    ->label('Other Names')
                    ->formatStateUsing(function (Profile $profile) {
                        return $profile->user->first_name . ' ' . $profile->user->middle_name;
                    }),
                Tables\Columns\TextColumn::make('dept')
                    ->label('Dept'),
                Tables\Columns\TextColumn::make('entry_year'),
                Tables\Columns\TextColumn::make('approval_date'),
                Tables\Columns\TextColumn::make('completed')
                    ->formatStateUsing(function (Profile $profile) {
                        if($profile->profile === true)
                        {return 'Yes';} return 'No';
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'view' => Pages\ViewProfile::route('/{record}'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
