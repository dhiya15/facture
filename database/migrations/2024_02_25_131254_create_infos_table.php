<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();

            $table->string("key")->nullable();
            $table->string("key_ar")->nullable();
            $table->string("image")->nullable();
            $table->string("full_name_ar")->nullable();
            $table->string("full_name_fr")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("address_ar")->nullable();
            $table->string("address_fr")->nullable();
            $table->string("register_number")->nullable();
            $table->string("id_number")->nullable();
            $table->string("statistics_number")->nullable();
            $table->string("account_number")->nullable();
            $table->string("agency_ar")->nullable();
            $table->string("agency_fr")->nullable();
            $table->string("header_ar")->nullable();
            $table->string("header_fr")->nullable();
            $table->boolean("default")->nullable();

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
        Schema::dropIfExists('infos');
    }
}
