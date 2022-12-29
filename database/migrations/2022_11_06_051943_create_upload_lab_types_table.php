<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadLabTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_lab_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upload_lab_id');
            $table->string('upload_type')->nullable();
            $table->string('value')->nullable();
            $table->text('comments')->nullable();
                       $table
                ->foreign('upload_lab_id')
                ->references('id')
                ->on('upload_labs')
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
        Schema::dropIfExists('upload_lab_types');
    }
}
