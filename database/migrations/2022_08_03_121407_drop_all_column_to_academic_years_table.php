<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAllColumnToAcademicYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('academic_years', 'year_start')) {
            Schema::table('academic_years', function (Blueprint $table) {
                $table->dropColumn('year_start');
            });
        }
        if (Schema::hasColumn('academic_years', 'year_total')) {
            Schema::table('academic_years', function (Blueprint $table) {
                $table->dropColumn('year_total');
            });
        }
        if (Schema::hasColumn('academic_years', 'created_at')) {
            Schema::table('academic_years', function (Blueprint $table) {
                $table->dropColumn('created_at');
            });
        }
        if (Schema::hasColumn('academic_years', 'updated_at')) {
            Schema::table('academic_years', function (Blueprint $table) {
                $table->dropColumn('updated_at');
            });
        }
        Schema::table('academic_years', function (Blueprint $table) {
            $table->string('name')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('academic_years', 'updated_at')) {
            Schema::table('academic_years', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
    }
}
