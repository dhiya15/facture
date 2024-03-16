<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("member_id")->nullable();
            $table->unsignedBigInteger("info_id")->nullable();

            $table->longText("products")->nullable();
            $table->string("number")->nullable();
            $table->string("lang")->nullable();
            $table->string("with_price")->nullable();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('SET NULL');
            $table->foreign('info_id')->references('id')->on('infos')->onDelete('SET NULL');

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
        Schema::dropIfExists('invoices');
    }
}
