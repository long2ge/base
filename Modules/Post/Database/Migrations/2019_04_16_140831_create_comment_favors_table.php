<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentFavorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'comment_favors';
        $dbConnection = config('modules.post.config.db-connection');

        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('comment_id');
            $table->unsignedInteger('user_id');
            $table->primary(['comment_id', 'user_id']);
        });

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '评论点赞表'");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'comment_favors';
        $dbConnection = config('modules.post.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
