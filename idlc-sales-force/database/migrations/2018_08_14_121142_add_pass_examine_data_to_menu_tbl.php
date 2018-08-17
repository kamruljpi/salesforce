<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPassExamineDataToMenuTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('mxp_menu')->insert(
            array(
                'name' => 'Examine Pass List',
                'route_name' => 'pass_examine_list_view',
                'description' => 'Examine Pass List',
                'parent_id' => 73,
                'is_active' => 1,
                'order_id' => 5
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}





