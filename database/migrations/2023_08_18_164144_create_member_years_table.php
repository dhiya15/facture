<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_years', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("member_id")->nullable();
            $table->unsignedBigInteger("year_id")->nullable();

            $table->double("amount")->default(0.0);
            $table->string("motif")->nullable();


            $table->foreign('member_id')->references('id')->on('members')->onDelete('SET NULL');
            $table->foreign('year_id')->references('id')->on('years')->onDelete('SET NULL');

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
        Schema::dropIfExists('members_years');
    }
}
