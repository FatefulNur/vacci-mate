<?php

use App\Enums\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nid', 10)->unique();
            $table->string('phone', 11)->unique();
            $table->string('status', 50)->default(UserStatus::NOT_VACCINATED->value);
            $table->foreignId('vaccine_center_id')->constrained();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->timestamp('scheduled_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['vaccine_center_id']);
            $table->dropIfExists();
        });
    }
};
