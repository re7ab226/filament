<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\EmployeeResource;
use Filament\Notifications\Notification;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
################################################################################################

    // protected function getCreatedNotificationTitle(): ?string
    // {
    //     return 'Employee Created';
    // }
     
protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Employee Created')
        ->body('The user has been created successfully.');
}


    #######################     ################################################
}
