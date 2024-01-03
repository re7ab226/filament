<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Doctrine\DBAL\Query;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\State;
use Filament\Notifications\Collection;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup='system_mangment';//  (تصنيف)بيعمل جروب
    protected static ?int $navigationSort=2;//  (تصنيف)بيعمل جروب


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Select::make('county_id')
                ->relationship(name:'country',titleAttribute:'name')
                ->native(false)// بيتحكم في شكل الدروب داون
                ->searchable()
                ->preload()
                ->live()
                ->required(),
                Forms\Components\Select::make('state_id')
                ->relationship(name:'state',titleAttribute:'name')
                ->native(false)
                // ->options
                // (
                // fn(Get $get):  Collection => State::Query()
                //     ->where('county_id', $get('county_id')))
                ->searchable()

                ->preload()
                ->live()
                    ->required(),
                Forms\Components\Select::make('city-id')
                ->relationship(name:'city',titleAttribute:'name')
                ->native(false)// بيتحكم في شكل الدروب داون
                    ->searchable()
                ->preload()
                    ->required(),
                    Forms\Components\Select::make('department-id')
                    ->relationship(name:'department',titleAttribute:'name')
                    ->native(false)// بيتحكم في شكل الدروب داون
                        ->searchable()
                    ->preload()
                        ->required(),           
                    //for user details
                    Forms\Components\Section::make('User_details')
                    ->description('put your details here')
                    ->schema([
               
// عملنا جروب للمعلومات
                Forms\Components\TextInput::make('f-name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('l-name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                    Forms\Components\DatePicker::make('date_birth')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                    ]),
                 //   ->columnSpanFull(),//بتجعل الحقل كبير
             
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('county_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city-id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department-id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('f-name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('l-name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
