<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chatbot extends Model
{
    protected $fillable = [
        'name',
        'ai_provider_id',
        'color',
        'position',
        'welcome_message',
        'is_active',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(AiProvider::class, 'ai_provider_id');
    }
}
