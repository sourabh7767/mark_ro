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
            $table->integer('year')->nullable()->default(null);
            $table->string('make')->nullable()->default(null);
            $table->string('model')->nullable()->default(null);
            $table->integer('estimator_id')->nullable()->default(null);
            $table->string('exterior_color')->nullable()->default(null);
            $table->string('body_style')->nullable()->default(null);
            $table->string('interior_color')->nullable()->default(null);
            $table->string('engine')->nullable()->default(null);
            $table->string('paint_code')->nullable()->default(null);
            $table->string('mileage_in')->nullable()->default(null);
            $table->string('mileage_out')->nullable()->default(null);
            $table->string('trim_code')->nullable()->default(null);
            $table->string('production_date')->nullable()->default(null);
            $table->string('license_plate')->nullable()->default(null);
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
