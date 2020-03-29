<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('record_id');
            $table->string('record_particular');
            $table->string('record_CBF')->nullable();
            $table->double('record_debit');
            $table->double('record_credit');
            $table->string('company_id');
            $table->enum('record_status',['0', '1']);
            $table->date('record_created_date');
            $table->date('record_english_date');
            $table->integer('fiscal_year_id');
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
        Schema::dropIfExists('records');
    }
}
