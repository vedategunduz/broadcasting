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
        Schema::disableForeignKeyConstraints();

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDeleteCascade();
            $table->foreignId('channel_id')->constrained('message_channels')->onDeleteCascade();
            $table->string('content');
            $table->enum('status', ['edited', 'deleted', 'saved'])->default('saved');
            $table->timestamps();
        });

        Schema::create('message_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->default('image/default_message.png');
            $table->enum('type', ['public', 'private', 'event', 'meeting'])->default('public');
            $table->timestamps();
        });

        Schema::create('message_channel_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_channel_id')->constrained()->onDeleteCascade();
            $table->foreignId('user_id')->constrained()->onDeleteCascade();
            $table->timestamps();
        });

        Schema::create('message_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained()->onDeleteCascade();
            $table->foreignId('user_id')->constrained()->onDeleteCascade();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('message_channels');
        Schema::dropIfExists('message_channel_users');
        Schema::dropIfExists('message_reads');
    }
};
