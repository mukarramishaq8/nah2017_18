<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPersonalInformations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('personal_informations',function(Blueprint $table){
            $table->string('email')->nullable();
            $table->boolean('disability')->default(false);
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
        Schema::table('personal_informations',function(Blueprint $table){
            $table->dropColumn('email');
            $table->dropColumn('disability');
        });
    }
}
