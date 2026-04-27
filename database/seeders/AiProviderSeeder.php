<?php

namespace Database\Seeders;

use App\Models\AiModel;
use App\Models\AiProvider;
use App\Models\AiVendor;
use Illuminate\Database\Seeder;

class AiProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function up(): void
    {
        $google = AiVendor::updateOrCreate(
            ['key' => 'google'],
            ['name' => 'Google']
        );

        $flash = AiModel::updateOrCreate(
            ['key' => 'gemini-1.5-flash', 'ai_vendor_id' => $google->id],
            ['name' => 'Gemini 1.5 Flash']
        );

        $pro = AiModel::updateOrCreate(
            ['key' => 'gemini-1.5-pro', 'ai_vendor_id' => $google->id],
            ['name' => 'Gemini 1.5 Pro']
        );

        AiProvider::updateOrCreate(
            ['name' => 'Google Gemini (Default)'],
            [
                'ai_vendor_id' => $google->id,
                'ai_model_id' => $flash->id,
                'api_key' => env('GOOGLE_AI_API_KEY'),
                'is_default' => true,
                'system_prompt' => 'Eres un asistente útil y cordial.',
            ]
        );
    }

    public function run(): void
    {
        $this->up();
    }
}
