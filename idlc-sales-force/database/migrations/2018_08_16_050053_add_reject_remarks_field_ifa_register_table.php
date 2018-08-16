<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRejectRemarksFieldIfaRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_ifa_registrations', function (Blueprint $table) {
            $table->string('rejection_remarks_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_ifa_registrations', function (Blueprint $table) {
            $table->dropColumn('rejection_remarks_id');
        });
    }
}
