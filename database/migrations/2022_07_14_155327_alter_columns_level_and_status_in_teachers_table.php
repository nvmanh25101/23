<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsLevelAndStatusInTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('teachers', 'level')) {
            Schema::table('teachers', function (Blueprint $table) {
                $table->Integer('level')->default(1)->change();
            });
        }
        if (Schema::hasColumn('teachers', 'status')) {
            Schema::table('teachers', function (Blueprint $table) {
                $table->Integer('status')->default(0)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
