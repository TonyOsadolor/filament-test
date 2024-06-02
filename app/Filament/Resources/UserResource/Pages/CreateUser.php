<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Account Created';
    }
    
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Account Created')
            ->body($this->data['email'] .'\'s Account Created Successfully.');
    }

    protected function handleRecordCreation(array $data): Model
    {
        /* return static::getModel()::create([
            'uuid' => Str::uuid(),
            'ref_num' => "SRP".rand(100000000, 999999999),
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make('12345678'),            
        ]); */

        $user = new User();
        // $user->ref_num = "SRP".rand(100000000, 999999999);
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        // $user->password = Hash::make('12345678');
        $user->save();

        Profile::initialProfile($user);

        return $user;
    }
}
