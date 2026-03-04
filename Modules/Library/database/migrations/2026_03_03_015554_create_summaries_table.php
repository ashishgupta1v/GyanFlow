<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Essential Laravel 13 helper to enable the vector engine
        Schema::ensureVectorExtensionExists(); 

        Schema::create('summaries', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Staff standard: Use UUIDs for scaling
            $table->foreignUuid('book_id')->constrained()->cascadeOnDelete();
            $table->text('hinglish_content');
            
            // This is the brain: A vector column with 1536 dimensions
            // 1536 is the industry standard for models like Claude 3.5
            $table->vector('embedding', dimensions: 1536)->index(); 
            
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('summaries');
    }
};