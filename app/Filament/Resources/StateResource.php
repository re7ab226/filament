<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\State;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\StateResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Filament\Resources\StateResource\RelationManagers\CityRelationManager;
use App\Filament\Resources\StateResource\RelationManagers\CitiesRelationManager;
use App\Filament\Resources\StateResource\RelationManagers\EmployeesRelationManager;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup='system_mangment';//  (تصنيف)بيعمل جروب
    protected static ?int $navigationSort=1;//  ()بيعمل للصفحه ترقيم ايه يجي قبل ايه 
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
                Forms\Components\Select::make('county_id')
             
                    ->relationship(name:'country',titleAttribute:'name')
                    ->native(false)// بيتحكم في شكل الدروب داون
                 ->searchable()
                 ->preload()
                    ->required(),
                           // ->options([
                    // 'active'=>'active',
                    // 'inactive'=>'inactive',
                    // ])
                  //   ->native(true)

                  
                   // ->multiple(),
                   // ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('county_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                ->sortable()
                    ->searchable(isIndividual:true),//دا ببيخصص ال search للحاجه دي 
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
                TextEntry::make('county_id'),
                TextEntry::make('name'),

 
            ]);
    }
    public static function getRelations(): array
    {
        return [
            CitiesRelationManager::class,
            EmployeesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
