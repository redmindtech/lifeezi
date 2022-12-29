<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('observation_id');
            $table->string('meal_type')->nullable();
            $table->string('meal_time')->nullable();
            $table->string('meal')->nullable();
            $table->string('comments')->nullable();
            $table
                ->foreign('observation_id')
                ->references('id')
                ->on('observations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
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
        Schema::dropIfExists('observation_types');
    }
}
