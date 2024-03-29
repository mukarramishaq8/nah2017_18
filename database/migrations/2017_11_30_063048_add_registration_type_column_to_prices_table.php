<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegistrationTypeColumnToPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('prices',function(Blueprint $table){
            $table->string('registration_type')->default('earlybird');
            $table->boolean('default')->default(false);
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
        Schema::table('prices',function(Blueprint $table){
            $table->dropColumn('registration_type');
            $table->dropColumn('default');
        });
    }
}
