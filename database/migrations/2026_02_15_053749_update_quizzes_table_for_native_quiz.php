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
        Schema::table('quizzes', function (Blueprint $table) {
            $table->integer('duration_minutes')->default(30)->after('description');
            $table->integer('passing_score')->default(70)->after('duration_minutes');
            $table->integer('max_attempts')->default(3)->after('passing_score');
            $table->boolean('show_answers')->default(true)->after('max_attempts');
            $table->boolean('shuffle_questions')->default(false)->after('show_answers');
            $table->string('gform_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
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
};
