<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use App\Models\Employee;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'All'=>Tab::make(),
            'This week'=>Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
          ->badge(Employee::query()->where('created_at', '>=', now()->subWeek())->count()),
            'This month'=>Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
            ->badge(Employee::query()->where('created_at', '=>', now()->subMonth())->count()),

            //دا هيخلي يعرض لي اللي في الاسبوع بتاع النهارده بس 
        ];
    }
}
