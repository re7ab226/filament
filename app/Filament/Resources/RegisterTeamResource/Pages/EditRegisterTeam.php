<?php

namespace App\Filament\Resources\RegisterTeamResource\Pages;

use App\Filament\Resources\RegisterTeamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegisterTeam extends EditRecord
{
    protected static string $resource = RegisterTeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
