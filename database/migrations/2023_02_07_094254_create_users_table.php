<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->enum('role', [
                'USER',
                'ADMIN',
            ]);
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->foreignId('photo_id')
                ->nullable()
                ->constrained('files')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('password');

            $table->string('fb_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
