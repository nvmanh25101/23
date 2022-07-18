<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CourseDetailStatus;
use App\Enums\CourseDetailType;

class AlterColumnToCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_details', function (Blueprint $table) {
            $table->string('type')->default(CourseDetailType::LICH_HOC)->change();
            $table->string('status')->default(CourseDetailStatus::MAC_DINH)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_details', function (Blueprint $table) {
            //
        });
    }
}
