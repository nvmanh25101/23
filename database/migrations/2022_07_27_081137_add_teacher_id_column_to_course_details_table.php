<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherIdColumnToCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_details', function (Blueprint $table) {
            $table->foreignId('teacher_id')->after('course_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('course_details', 'teacher_id')) {
            Schema::table('course_details', function (Blueprint $table) {
                $table->dropForeign(['teacher_id']);
                $table->dropColumn('teacher_id');
            });
        }
    }
}
