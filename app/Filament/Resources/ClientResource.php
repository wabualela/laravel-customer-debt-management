<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $label = 'العملاء';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')->required()->label('الاسم الاول'),
                Forms\Components\TextInput::make('last_name')->required()->label('الاسم الثاني'),
                Forms\Components\TextInput::make('tel')->required()->label('رقم الهاتف'),
                Forms\Components\TextInput::make('address')->required()->label('عنوان السكن'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->sortable()->searchable()->label('الاسم الاول'),
                Tables\Columns\TextColumn::make('last_name')->sortable()->searchable()->label('الاسم الثاني'),
                Tables\Columns\TextColumn::make('tel')->sortable()->searchable()->label('رقم الهاتف'),
                Tables\Columns\TextColumn::make('address')->sortable()->searchable()->label('عنوان السكن'),
                Tables\Columns\TextColumn::make('transactions_count')->counts('transactions')->sortable()->searchable()->label('عدد الطلبات'),
                Tables\Columns\TextColumn::make('transactions_sum_amount')->sum('transactions','amount')->sortable()->searchable()->label('اجمالي الديون'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
