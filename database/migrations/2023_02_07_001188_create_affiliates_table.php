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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->longText('description')->nullable();
            $table->string('link')->nullable();

            $table->string('image')->nullable();

            $table->foreignId('city_id')
                ->nullable()
                ->constrained('cities')
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('master_id')->nullable();

            // $table->unsignedBigInteger('parent_id')->default(0);

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
        Schema::dropIfExists('affiliates');
    }
};
