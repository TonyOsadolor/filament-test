<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Traits\ResourceMasksRecordId;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Grouping\Group;

class UserResource extends Resource
{
    use ResourceMasksRecordId;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(11)
                    ->required()
                    ->unique(column: 'phone',ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'The :attribute has already been registered.',
                    ])
                    ->label(__('Student Phone'))
                    ->placeholder('Enter Phone'),
                    // ->hidden(fn (string $operation): bool => $operation === 'create'),
                
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(column: 'email',ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'The :attribute has already been registered.',
                    ])
                    ->label(__('Student Email'))
                    ->placeholder('Enter Valid Email'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make('created_at')
                    ->orderQueryUsing(fn (Builder $query, string $direction) => $query->orderBy('created_at', $direction)),
                ])
            ->columns([
                Tables\Columns\TextColumn::make('surname'),
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Other Names')
                    ->formatStateUsing(function (User $user) {
                        return $user->first_name . ' ' . $user->middle_name;
                    }),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('admin_level')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
