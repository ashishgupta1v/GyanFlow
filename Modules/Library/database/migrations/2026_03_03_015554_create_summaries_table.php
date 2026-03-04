<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            // ensure pgvector extension exists on Postgres
            DB::statement('CREATE EXTENSION IF NOT EXISTS vector');

            Schema::create('summaries', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignUuid('book_id')->constrained()->cascadeOnDelete();
                // pgvector column (1536 dims used by many embedding models)
                $table->vector('embedding', 1536)->nullable();
                $table->timestamps();
            });
        } else {
            // Fallback for SQLite (CI/tests) and other drivers: store embedding as JSON
            Schema::create('summaries', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignUuid('book_id')->constrained()->cascadeOnDelete();
                // use json to keep tests working (no vector support in SQLite)
                $table->json('embedding')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('summaries');
    }
};