<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_owner_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('rating'); // 1 to 5
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->string('category')->nullable(); // e.g., "Service", "Product", "Support"
            $table->boolean('is_flagged')->default(false); // unrelated feedback
            $table->boolean('is_public')->default(true);
            $table->string('user_name')->nullable(); // for anonymous feedback
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
