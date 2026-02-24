<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop tables yang tidak dipakai
        Schema::dropIfExists('question_answers');
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('questions');

        // Simplify quizzes table
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn([
                'duration_minutes',
                'passing_score',
                'max_attempts',
                'show_answers',
                'shuffle_questions',
            ]);
        });
    }

    public function down(): void
    {
        // Recreate columns
        Schema::table('quizzes', function (Blueprint $table) {
            $table->integer('duration_minutes')->default(30);
            $table->integer('passing_score')->default(70);
            $table->integer('max_attempts')->default(3);
            $table->boolean('show_answers')->default(true);
            $table->boolean('shuffle_questions')->default(false);
        });
    }
};
