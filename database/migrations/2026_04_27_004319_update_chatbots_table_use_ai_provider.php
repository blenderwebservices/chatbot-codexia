<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chatbots', function (Blueprint $table) {
            $table->dropForeign(['ai_agent_id']);
            $table->dropColumn('ai_agent_id');
            $table->foreignId('ai_provider_id')->after('name')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chatbots', function (Blueprint $table) {
            $table->dropForeign(['ai_provider_id']);
            $table->dropColumn('ai_provider_id');
            $table->foreignId('ai_agent_id')->after('name')->nullable();
        });
    }
};
