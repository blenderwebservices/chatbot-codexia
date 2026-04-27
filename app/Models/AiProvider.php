<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiProvider extends Model
{
    protected $fillable = [
        'name',
        'ai_vendor_id',
        'api_key',
        'base_url',
        'ai_model_id',
        'system_prompt',
        'roi_system_prompt',
        'raci_system_prompt',
        'is_default',
        'web_search_enabled',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(AiVendor::class, 'ai_vendor_id');
    }

    public function aiModel(): BelongsTo
    {
        return $this->belongsTo(AiModel::class, 'ai_model_id');
    }
}
