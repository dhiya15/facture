<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDarJma3aExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dar_jma3a_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("type_id")->nullable();
            $table->double("amount");
            $table->string("description")->nullable();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('SET NULL');
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
        Schema::dropIfExists('dar_jma3a_expenses');
    }
}
