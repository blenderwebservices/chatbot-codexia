<?php

namespace App\Filament\Resources\AiProviders;

use App\Filament\Resources\AiProviders\Pages;
use App\Filament\Resources\AiProviders\Schemas\AiProviderForm;
use App\Filament\Resources\AiProviders\Tables\AiProvidersTable;
use App\Models\AiProvider;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class AiProviderResource extends Resource
{
    protected static ?string $model = AiProvider::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationLabel = 'Configuración IA';

    protected static ?string $pluralLabel = 'Configuraciones IA';

    protected static ?string $modelLabel = 'Configuración IA';

    protected static string|UnitEnum|null $navigationGroup = 'Administración';

    public static function form(Schema $schema): Schema
    {
        return AiProviderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiProvidersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAiProviders::route('/'),
            'create' => Pages\CreateAiProvider::route('/create'),
            'edit' => Pages\EditAiProvider::route('/{record}/edit'),
        ];
    }
}
