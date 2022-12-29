<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->foreignId('onboarding_id');
            $table->string('date')->nullable();
            $table->string('day_of_observation')->nullable();
            $table->string('wake_up_time')->nullable();
            $table->string('bed_time')->nullable();
            $table->string('exercise_routine')->nullable();
            $table->string('steps')->nullable();
            $table->string('water_intake')->nullable();
                        $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('onboarding_id')
                ->references('id')
                ->on('onboardings')
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
        Schema::dropIfExists('observations');
    }
}
