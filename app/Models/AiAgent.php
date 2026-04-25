<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiAgent extends Model
{
    protected $fillable = [
        'name',
        'description',
        'system_prompt',
        'vendor',
        'model',
        'api_key',
        'base_url',
        'is_active',
        'is_default',
        'web_search_enabled',
    ];
}
