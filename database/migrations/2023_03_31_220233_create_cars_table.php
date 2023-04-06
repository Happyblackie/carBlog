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
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('founded');
            $table->longText('description');
            $table->timestamps();
        });

        //table relationship one to many
        
        Schema::create('car_models', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('car_id');
            $table->string('model_name');
            $table->timestamps();
            $table->foreign('car_id')
                    ->references('id')
                    ->on('cars')
                    ->onDelete('cascade'); //or you can set it to null
        });

        //we can as well create a schema for engines model but, 
        //lets create a migration and a model this time around
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
