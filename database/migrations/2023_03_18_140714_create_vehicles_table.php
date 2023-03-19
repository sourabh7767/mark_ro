<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('make_year');
            $table->integer('estimator_id')->nullable();
            $table->string('exterior_color');
            $table->string('body_style');
            $table->string('interior_color');
            $table->string('engine');
            $table->string('paint_code');
            $table->string('mileage_in');
            $table->string('mileage_out');
            $table->string('trim_code');
            $table->date('production_date');
            $table->string('license_plate');
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
        Schema::dropIfExists('vehicles');
    }
}
