<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('amount');
            $table->integer('term');
            $table->decimal('rate', 21, 6);
            $table->integer('start_month');
            $table->integer('start_year');
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
        Schema::table('loans', function (Blueprint $table)
        {
            $table->dropForeign('loans_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('loans');
    }
}
