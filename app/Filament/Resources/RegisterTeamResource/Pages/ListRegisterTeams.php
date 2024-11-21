<?php

namespace App\Filament\Resources\RegisterTeamResource\Pages;

use App\Filament\Resources\RegisterTeamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegisterTeams extends ListRecords
{
    protected static string $resource = RegisterTeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
