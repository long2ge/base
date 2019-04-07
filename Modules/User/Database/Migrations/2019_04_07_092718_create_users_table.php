<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'users';
        $dbConnection = config('modules.user.config.db-connection');
        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->nullable()->comment('账号');
            $table->string('username')->nullable()->comment('用户名');
            $table->string('phone_number', 20)->nullable()->comment('手机号码');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('password')->nullable()->comment('密码');
            $table->integer('occupation_id')->nullable()->comment('职业id');

            $table->string('profile')->default('')->comment('个人简介');
            $table->string('avatar')->default('')->comment('头像url');
            $table->string('address')->default('')->comment('详细地址');
            $table->integer('province_id')->default(0)->comment('省份id');
            $table->integer('city_id')->default(0)->comment('城市id');
            $table->integer('zone_id')->default(0)->comment('区/县 id');
            $table->integer('sex')->default(1)->comment('性别 1男，0女');
            $table->integer('status')->default(1)->comment('用户状态 1正常，0冻结');

            $table->timestampsTz();
            $table->softDeletes();
        });

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '用户表'");

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` AUTO_INCREMENT = 10000001");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'users';
        $dbConnection = config('modules.user.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
