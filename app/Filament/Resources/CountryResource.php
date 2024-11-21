<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Country;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\CountryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Filament\Resources\CountryResource\RelationManagers\StateRelationManager;
use App\Filament\Resources\CountryResource\RelationManagers\StatesRelationManager;
use App\Filament\Resources\CountryResource\RelationManagers\EmployeesRelationManager;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup='system_mangment';//  (تصنيف)بيعمل جروب
    protected static ?int $navigationSort=4;//  (تصنيف)بيعمل جروب

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    //خاص بالعدد
    public static function getNavigationBadgeColor(): ?string
    {
    // return 'warning';
        return static::getModel()::count() > 5? 'warning' : 'sucess';
        //خاص بلون العدد
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        
            ->schema([
                Section::make('countries info')
                ->schema([TextEntry::make('name')->label('country name')
                ])
                //->coulmn(2) الجزء دا خاص بالتنسيق
             ]);
 
       
    }
    public static function getRelations(): array
    {
        return [
            StateRelationManager::class,

            //في الحاله دي هقدر اجيب البلد واعدل ال state كمان :)
            EmployeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            // 'view' => Pages\ViewCountry::route('/{record}'),//لم عملنا لدا كومنت هيظهر الفيو في الصفحه نفسها
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
