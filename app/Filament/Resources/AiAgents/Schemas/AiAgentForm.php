<?php

namespace App\Filament\Resources\AiAgents\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AiAgentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Select::make('vendor')
                    ->options([
                        'openai' => 'OpenAI',
                        'anthropic' => 'Anthropic',
                        'google' => 'Google (Gemini)',
                        'groq' => 'Groq',
                    ])
                    ->required()
                    ->live(),
                TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                TextInput::make('api_key')
                    ->password()
                    ->revealable()
                    ->maxLength(255),
                TextInput::make('base_url')
                    ->url()
                    ->maxLength(255),
                Textarea::make('system_prompt')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->default(true),
                Toggle::make('is_default')
                    ->default(false),
                Toggle::make('web_search_enabled')
                    ->default(false),
            ]);
    }
}
