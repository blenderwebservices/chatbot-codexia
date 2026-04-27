<?php

namespace App\Filament\Resources\AiProviders\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AiProvidersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('vendor.name')
                    ->label('Proveedor')
                    ->searchable(),
                TextColumn::make('aiModel.name')
                    ->label('Modelo')
                    ->searchable(),
                IconColumn::make('is_default')
                    ->label('Por defecto')
                    ->boolean(),
                IconColumn::make('web_search_enabled')
                    ->label('Búsqueda Web')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
