<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'comments';
        $dbConnection = config('modules.post.config.db-connection');

        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('post_id');
            $table->text('content');
            $table->json('response_ids_cache')->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '评论表'");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'comments';
        $dbConnection = config('modules.post.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
