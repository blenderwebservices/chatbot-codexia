<?php

namespace App\Filament\Resources\Chatbots;

use App\Filament\Resources\Chatbots\Pages\CreateChatbot;
use App\Filament\Resources\Chatbots\Pages\EditChatbot;
use App\Filament\Resources\Chatbots\Pages\ListChatbots;
use App\Filament\Resources\Chatbots\Schemas\ChatbotForm;
use App\Filament\Resources\Chatbots\Tables\ChatbotsTable;
use App\Models\Chatbot;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ChatbotResource extends Resource
{
    protected static ?string $model = Chatbot::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedComputerDesktop;

    protected static ?string $navigationLabel = 'Chatbots';

    protected static ?string $pluralLabel = 'Chatbots';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ChatbotForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChatbotsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChatbots::route('/'),
            'create' => CreateChatbot::route('/create'),
            'edit' => EditChatbot::route('/{record}/edit'),
        ];
    }
}
