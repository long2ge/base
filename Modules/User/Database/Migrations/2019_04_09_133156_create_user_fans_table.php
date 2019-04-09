<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'user_fans';
        $dbConnection = config('modules.user.config.db-connection');
        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unsignedInteger('fan_id')->comment('粉丝id');
            $table->timestampTz('created_at')->comment('创建时间');
        });
        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '用户粉丝表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'user_fans';
        $dbConnection = config('modules.user.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
