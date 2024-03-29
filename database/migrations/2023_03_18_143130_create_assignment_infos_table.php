<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('claim_number')->nullable()->default(null);
            $table->string('claim_type')->nullable()->default(null);
            $table->string('loss_type')->nullable()->default(null);
            $table->datetime('loss_time')->nullable()->default(null);
            $table->string('payer')->nullable()->default(null);
            $table->string('insurance_prepaid_amount')->nullable()->default(null);
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
        Schema::dropIfExists('assignment_infos');
    }
}
