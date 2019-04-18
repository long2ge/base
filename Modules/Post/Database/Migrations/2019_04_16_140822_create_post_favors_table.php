<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostFavorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'post_favors';
        $dbConnection = config('modules.post.config.db-connection');

        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('user_id');
            $table->primary(['post_id', 'user_id']);
        });

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '帖子点赞表'");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'post_favors';
        $dbConnection = config('modules.post.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
