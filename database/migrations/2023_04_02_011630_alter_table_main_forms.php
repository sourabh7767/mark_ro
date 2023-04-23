<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMainForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_forms', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->date('date_in')->nullable();
            $table->date('date_out')->nullable();
            $table->date('target_date')->nullable();
            $table->date('due_date')->nullable();
            $table->float('labour_hours', 8, 2)->nullable();
            $table->float('sales_amount', 8, 2)->nullable();


            $table->integer('wheel')->comment("0=>not checked,1=>checked")->default(0)->nullable();
            $table->date('wheel_date')->nullable();
            $table->integer('alignment')->comment("0=>not checked,1=>checked")->default(0)->nullable();
            $table->date('alignment_date')->nullable();
            $table->integer('decals')->comment("0=>not checked,1=>checked")->default(0)->nullable();
            $table->date('decals_date')->nullable();
            $table->integer('glass')->comment("0=>not checked,1=>checked")->default(0)->nullable();
            $table->date('glass_date')->nullable();
            $table->integer('adas')->comment("0=>not checked,1=>checked")->default(0)->nullable();
            $table->date('adas_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_forms', function (Blueprint $table) {
            //
        });
    }
}
