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
            $table->longText('description')->nullable();
            $table->string('address');

            $table->foreignId('image_id')
                ->nullable()
                ->constrained('files')
                ->cascadeOnUpdate();

            $table->foreignId('city_id')
                ->nullable()
                ->constrained('cities')
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('master_id')->nullable();

            $table->unsignedBigInteger('parent_id')->default(0);

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
