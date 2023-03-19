<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('insurance_company')->nullable()->default(null);
            $table->string('claim_office')->nullable()->default(null);
            $table->string('phone_number')->nullable()->default(null);
            $table->string('adjuster')->nullable()->default(null);
            $table->string('policy_number')->nullable()->default(null);
            $table->string('insurance_agent')->nullable()->default(null);
            $table->string('deductible')->nullable()->default(null);
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
        Schema::dropIfExists('insurances');
    }
}
