<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paciente_id')->index()->unsigned()->nullable();
            $table->integer('horario_id')->index()->unsigned()->nullable();
            $table->string('asunto');
            $table->date('dia');
            $table->enum('estado', ['PENDIENTE', 'FINALIZADA', 'RECHAZADA'])->default('PENDIENTE');

            $table->foreign('paciente_id')
                ->references('id')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->foreign('horario_id')
                ->references('id')
                ->on('horarios')
                ->onDelete('cascade');

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
        Schema::dropIfExists('citas');
    }
}
