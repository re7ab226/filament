<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Doctrine\DBAL\Query;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Get;
use Filament\Resources\Set;
use Illuminate\Support\Carbon;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Notifications\Collection;
use Filament\Tables\Filters\Indicator;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\EmployeeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmployeeResource\RelationManagers;

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
       // Forms\Components\Section::make('Relationship')
          //  ->schema([
                Forms\Components\Select::make('county_id')
                ->relationship(name:'country',titleAttribute:'name')
                ->native(false)// بيتحكم في شكل الدروب داون
                ->searchable()
                ->preload()
                ->live()
                // ->afterStateUpdate(function(Set $set)
                // {
                //     $set('state_id', null);
                // })

                ->required(),
                Forms\Components\Select::make('state_id')
                // ->options(
                //     fn(Get $get):Collection => State::Query()
                //         ->where('county_id', $get('county_id'))
                // )
                ->relationship(name: 'state', titleAttribute: 'name') // Assuming you have a 'state' relationship
                ->native(false) // Controls the appearance of the dropdown
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
                    Forms\Components\Select::make('department_id')
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
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required()

                    ->maxLength(255),
                    ]),
                 //   ->columnSpanFull(),//بتجعل الحقل كبير
              //  ]),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('county_id')
               // ->hidden(true)//هذ الجزء بيخليه مخفي من الview
               ->hidden(!auth()->user()->email=='rehab@gmail.com')//بالشكل دا اقدر  اخلي اي حد مش بالايميل دا مايشوفش الحقل دا
              ->visible(!auth()->user()->email=='yousra@gmail')//دا العكس بقي لو اليوزر دادخل ماتبينش ليه حاجه
               // ->hidden(auth()->user()->email=='rehab@gmail.com')//كدا خليت اليوزر الللي بالايميل دا مايشوفش الجزء دا
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_id')
                  
                ->visible(!auth()->user()->email=='yousra@gmail')//دا العكس بقي لو اليوزر دادخل ماتبينش ليه حاجه
                ->numeric()
                ->toggleable(isToggledHiddenByDefault: true)

                    ->sortable(),
                Tables\Columns\TextColumn::make('city-id')
                ->visible(!auth()->user()->email=='yousra@gmail')//دا العكس بقي لو اليوزر دادخل ماتبينش ليه حاجه
                ->toggleable(isToggledHiddenByDefault: true)

                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
                ->visible(!auth()->user()->email=='yousra@gmail')//دا العكس بقي لو اليوزر دادخل ماتبينش ليه حاجه
                ->toggleable(isToggledHiddenByDefault: true)

                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('f-name')

                 ->searchable(isIndividual:true,isGlobal:false),//دا اللي بيعمل سيرش//isGlobal:false دا مش بيخليك تعمل سيرش في الجلوبال
                Tables\Columns\TextColumn::make('l-name')

                    ->searchable(),
                Tables\Columns\TextColumn::make('email')


                    ->searchable(),
                Tables\Columns\TextColumn::make('date_birth')
                ->toggleable(isToggledHiddenByDefault: true)

                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                ->toggleable(isToggledHiddenByDefault: true)

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
            ->defaultSort('f-name','desc')
//////////////////////////////دا عشان عامله علاقه many to many with department ععرفت اعمل فلتر بالموديل 
//////////////////////////////////////////////////////////////////////////////////////////////////

                ->filters([
                SelectFilter::make('Department')
                ->relationship('department', 'name')
                ->searchable()
                ->preload()
                ->label('filter by department')
                ->indicator('department'),
                //بتعرفك انت بتبحث عن ايه 
                // Filter::make('created_at')
                // ->form([
                //     DatePicker::make('created_from'),
                //     DatePicker::make('created_until'),
                // ])
                // ->query(function (Builder $query, array $data): Builder {
                //     return $query
                //         ->when(
                //             $data['created_from'],
                //             fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                //         )
                //         ->when(
                //             $data['created_until'],
                //             fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                //         );
                // })
                // ->indicateUsing(function (array $data): array {
                //     $indicators = [];
             
                //     if ($data['from'] ?? null) {
                //         $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['from'])->toFormattedDateString())
                //             ->removeField('from');
                //     }
             
                //     if ($data['until'] ?? null) {
                //         $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['until'])->toFormattedDateString())
                //             ->removeField('until');
                //     }
             
                //     return $indicators;
                // })
                                       
            ],layout: FiltersLayout::Modal)
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
            Section::make(' info')//عامل سيكشن في حاله ال VIEW
            ->schema([
            TextEntry::make('state_id')->label('state'),
                 TextEntry::make('county_id')->label('country'),//دي بتهندل ال viewللعنصر الواحد
                 TextEntry::make('city-id')->label('city'),
                  TextEntry::make('department_id')->label('department'),
                  ])
                  ->columns(4),
            Section::make('user info')//عامل سيكشن في حاله ال VIEW
            ->schema([
                TextEntry::make('f-name')->label('name'),
                   TextEntry::make('l-name')->label('nickname'),
                 TextEntry::make('email')->label('Email'),
                  TextEntry::make('date_birth')->label('birthdate'),
                    TextEntry::make('address')->label('state'),

        //   في الفيو بتعرفك كم حد من الاعضاء واخد الصنف دا 
    
        ])->columns(2)

        ]);

    }
    public static function getRelations(): array
    {
        return [
            //php artisan make:filament-relation-manager بعد ما اعمل الامر دا اروح ع هنا واعمل العلاقه 
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
