<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccupationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'occupations';
        $dbConnection = config('modules.user.config.db-connection');
        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('职业名字');
            $table->integer('creator_id')->comment('创建者id');
            $table->timestampsTz();
            $table->softDeletes();
        });

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '职业表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'occupations';
        $dbConnection = config('modules.user.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
