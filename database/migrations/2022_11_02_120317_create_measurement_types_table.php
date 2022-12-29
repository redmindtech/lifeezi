<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurement_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('measurement_id');
            $table->string('measurement_type')->nullable();
            $table->string('value')->nullable();
            $table->text('comments')->nullable();
            $table
                ->foreign('measurement_id')
                ->references('id')
                ->on('measurements')
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
        Schema::dropIfExists('measurement_types');
    }
}
