<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnsToTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('teachers', 'name')) {
            Schema::table('teachers', function (Blueprint $table) {
                $table->string('name')->after('password');
            });
        }

        if (!Schema::hasColumn('teachers', 'birthdate')) {
            Schema::table('teachers', function (Blueprint $table) {
                $table->timestamp('birthdate')->after('password');
            });
        }

        if (!Schema::hasColumn('teachers', 'gender')) {
            Schema::table('teachers', function (Blueprint $table) {
                $table->boolean('gender')->default(false)->after('password');
            });
        }

        if (!Schema::hasColumn('teachers', 'address')) {
            Schema::table('teachers', function (Blueprint $table) {
                $table->string('address')->after('password');
            });
        }

        if (!Schema::hasColumn('teachers', 'phone')) {
            Schema::table('teachers', function (Blueprint $table) {
                $table->string('phone')->after('password');
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
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
}
