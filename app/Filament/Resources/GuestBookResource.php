<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestBookResource\Pages;
use App\Filament\Resources\GuestBookResource\RelationManagers;
use App\Models\GuestBook;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuestBookResource extends Resource
{
  protected static ?string $model = GuestBook::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        TextInput::make('name')->required(),
        TextInput::make('email')->required()->email()->unique(ignoreRecord: true),
        Textarea::make('message')->required(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name')->limit(20)->sortable()->searchable(),
        TextColumn::make('email')->limit(20)->sortable()->searchable(),
        TextColumn::make('message')->limit(20)->sortable()->searchable()->wrap(),
      ])
      ->filters([
        //
      ])
      // ->defaultSort('name', 'asc')
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
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
      'index' => Pages\ListGuestBooks::route('/'),
      'create' => Pages\CreateGuestBook::route('/create'),
      'edit' => Pages\EditGuestBook::route('/{record}/edit'),
    ];
  }
}
