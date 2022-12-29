<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->string('plan_start_date')->nullable();
            $table->string('plan_end_date')->nullable();
            $table->string('mail_send_date')->nullable();
            $table->string('explanation_date')->nullable();
            $table->string('objective')->nullable();
            $table->string('wake_up_time')->nullable();
            $table->string('bed_time')->nullable();
            $table->text('steps')->nullable();
            $table->string('water_intake')->nullable();
            $table->text('food_to_avoid')->nullable();
            $table->text('comments')->nullable();
             $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients')
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
        Schema::dropIfExists('plannings');
    }
}
