<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmployeeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmployeeResource\RelationManagers;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('country_id')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('state_id')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('city_id')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('department_id')
                //     ->required()
                //     ->numeric(),

                // questo serve per creare un riquadro a parte e poterlo customizzare meglio "Section"
                Forms\Components\Section::make('User Name')
                ->description('Put the user name details in.')
                ->schema([

                    Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('middle_name')
                    ->required()
                    ->maxLength(255)
                ])->columns(3),
                Forms\Components\Section::make('User address')
                ->schema([
                    Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                ])->columns(2),
                Forms\Components\Section::make('Dates')
                ->schema([
                    Forms\Components\DatePicker::make('date_of_birth')
                    ->required(),
                    Forms\Components\DatePicker::make('date_hired')
                    ->required()
                    // con questo comando allunghi il capo del form in modo che prenda tutta la larghezza disponibile.
                    // ->columnSpanFull(),
                ])->columns(2),
                    // qua si decidono il numero di colonnne in cui sono divisi i campi del form(non è un opzione di default)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_hired')
                    ->date()
                    ->sortable(),
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
