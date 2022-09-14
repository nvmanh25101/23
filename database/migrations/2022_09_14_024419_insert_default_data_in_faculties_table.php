<?php

use App\Enums\TeacherLevelEnum;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertDefaultDataInFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faculties', function (Blueprint $table) {
            //
        });
        DB::table('faculties')->insert(
            array(
                'id' => 1,
                'name' => 'Phòng đào tạo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'type' => TeacherLevelEnum::GIANG_VIEN,
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
        Schema::table('faculties', function (Blueprint $table) {
            //
        });
    }
}
