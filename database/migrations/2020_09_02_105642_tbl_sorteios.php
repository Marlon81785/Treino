<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSorteios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sorteios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usr_responsavel_id');
            $table->string('nome_sorteio');
            $table->string('descricao_sorteio');
            $table->integer('quant_rifas');
            $table->date('data_sorteio');
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
            $table->string('img4');
            $table->string('img5');
            $table->string('status');
            $table->string('mini_desc');
            $table->float('valor_por_unidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sorteios');
    }
}
