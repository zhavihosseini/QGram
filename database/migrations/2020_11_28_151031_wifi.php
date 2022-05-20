<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Wifi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifi',function (Blueprint $table){
            $table->id('id');
            $table->string('status');
            $table->string('time');
            $table->text('desc');
            $table->string('download');
            $table->integer('userid');
            $table->text('ssid');
            $table->text('pwd');
            $table->text('hidden');
            $table->string('enc');
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
        //
    }
}
