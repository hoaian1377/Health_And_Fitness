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
        Schema::table('users', function (Blueprint $table) {
            // Kiểm tra xem cột đã tồn tại chưa trước khi thêm
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'dob')) {
                $table->date('dob')->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('users', 'height')) {
                $table->decimal('height', 5, 2)->nullable(); // cm
            }
            if (!Schema::hasColumn('users', 'weight')) {
                $table->decimal('weight', 5, 2)->nullable(); // kg
            }
            if (!Schema::hasColumn('users', 'bmi')) {
                $table->decimal('bmi', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('users', 'blood_type')) {
                $table->string('blood_type')->nullable();
            }
            if (!Schema::hasColumn('users', 'activity_level')) {
                $table->enum('activity_level', ['sedentary', 'light', 'moderate', 'active', 'very_active'])->nullable();
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable();
            }
            if (!Schema::hasColumn('users', 'subscription_plan')) {
                $table->enum('subscription_plan', ['free', 'premium'])->default('free');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'dob',
                'gender',
                'address',
                'height',
                'weight',
                'bmi',
                'blood_type',
                'activity_level',
                'avatar',
                'subscription_plan'
            ]);
        });
    }
};
