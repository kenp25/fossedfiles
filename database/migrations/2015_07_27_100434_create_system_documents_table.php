<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_documents',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('system_code');
            $table->string('document_code');
            $table->string('description');
            $table->string('user_id');
            $table->string('path');
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
        Schema::drop('system_documents');
    }
}
