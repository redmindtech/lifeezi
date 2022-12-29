<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisengagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disengagements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->string('disengagement_type')->nullable();
            $table->string('date')->nullable();
            $table->string('disengagement_reason')->nullable();
            $table->string('comments')->nullable();
            $table->string('reviewed_by')->nullable();
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
        Schema::dropIfExists('disengagements');
    }
}
