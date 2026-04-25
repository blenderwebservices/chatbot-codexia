<?php

namespace App\Filament\Resources\Chatbots\Pages;

use App\Filament\Resources\Chatbots\ChatbotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChatbots extends ListRecords
{
    protected static string $resource = ChatbotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
