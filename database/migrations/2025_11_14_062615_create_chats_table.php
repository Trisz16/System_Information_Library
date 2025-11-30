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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'admin_chat' or 'ai_assistant'
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_staff_id')->nullable()->constrained('users')->onDelete('cascade'); // null for AI assistant
            $table->string('status')->default('active'); // active, closed
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
