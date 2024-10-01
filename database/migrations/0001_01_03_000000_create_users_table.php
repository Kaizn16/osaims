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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username')->nullable();
            $table->string('student_id')->nullable();
            $table->string('fullname');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('year_level')->nullable();
            $table->bigInteger('age');
            $table->string('sex');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('availability_status_id')->default(0)->nullable();
            $table->string('email')->unique();
            $table->string('contact_no')->unique()->nullable();
            $table->string('password');
            $table->boolean('is_deleted')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('department_id')
                  ->references('department_id')
                  ->on('departments')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('course_id')
                  ->references('course_id')
                  ->on('courses')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('role_id')
                  ->references('role_id')
                  ->on('roles')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('position_id')  
                  ->references('position_id')
                  ->on('positions')
                  ->onUpdate('set null')
                  ->onDelete('set null');
            
            $table->foreign('availability_status_id')
                  ->references('availability_status_id')
                  ->on('availability_status')
                  ->onUpdate('set null')
                  ->onDelete('set null');

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
