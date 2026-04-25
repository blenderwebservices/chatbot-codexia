<?php

namespace App\Filament\Resources\Chatbots\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Actions;
use Filament\Actions\Action;
use Filament\Schemas\Schema;

class ChatbotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Configuración General')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->maxLength(255),
                                Select::make('ai_agent_id')
                                    ->label('Agente IA (Cerebro)')
                                    ->relationship('agent', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                            ]),
                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true),
                            
                        Actions::make([
                            Action::make('generate_script')
                                ->label('Generar Script de Integración')
                                ->color('primary')
                                ->icon('heroicon-o-code-bracket')
                                ->modalHeading('¡Tu Script está listo!')
                                ->modalSubmitAction(false)
                                ->modalCancelActionLabel('Cerrar')
                                ->modalContent(function ($record) {
                                    if (! $record) {
                                        return new \Illuminate\Support\HtmlString('<p class="text-red-500">Debes guardar el chatbot primero para poder generar el script de integración.</p>');
                                    }
                                    $script = '<script src="' . url('/bot.js') . '" data-chatbot-id="' . $record->id . '"></script>';
                                    return new \Illuminate\Support\HtmlString('
                                        <p class="text-gray-500 dark:text-gray-400 mb-4">Copia y pega este código antes de cerrar la etiqueta <code>&lt;/body&gt;</code> de tu sitio web.</p>
                                        <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-xl border border-gray-300 dark:border-gray-700">
                                            <code class="text-blue-600 dark:text-blue-400 text-sm break-all">' . htmlentities($script) . '</code>
                                        </div>
                                    ');
                                })
                        ])
                        ->fullWidth(),
                    ]),

                Section::make('Personalización')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                ColorPicker::make('color')
                                    ->required()
                                    ->live()
                                    ->default('#3b82f6'),
                                Select::make('position')
                                    ->label('Posición')
                                    ->options([
                                        'right' => 'Derecha',
                                        'left' => 'Izquierda',
                                    ])
                                    ->required()
                                    ->live()
                                    ->default('right'),
                                Textarea::make('welcome_message')
                                    ->label('Mensaje de Bienvenida')
                                    ->rows(3)
                                    ->live(onBlur: true)
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make('Vista Previa en Tiempo Real')
                    ->schema([
                        ViewField::make('preview')
                            ->label('')
                            ->view('filament.forms.components.chatbot-preview'),
                    ]),
            ]);
    }
}
