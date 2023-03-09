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
        Schema::create('affiliate_banners', function (Blueprint $table) {
            $table->id();

            $table->foreignId('image_id')
                ->nullable()
                ->constrained('files');

            $table->foreignId('affiliate_id')
                ->nullable()
                ->constrained('affiliates');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliate_banners');
    }
};
