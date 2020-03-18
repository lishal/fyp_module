<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearlyRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearly_records', function (Blueprint $table) {
            $table->increments('yearly_record_id');
            $table->integer('yearly_record_session');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')
              ->references('id')->on('companies')
              ->onDelete('cascade');
            $table->enum('yearly_record_status', ['dr', 'cr']);
            $table->double('yearly_record_balance');
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
        Schema::dropIfExists('yearly_records');
    }
}
