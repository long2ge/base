<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'posts';
        $dbConnection = config('modules.post.config.db-connection');

        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('content');
            $table->unsignedInteger('view')->default(0);
            $table->boolean('stick')->default(0);
            $table->string('source')->default('web');
            $table->dateTime('last_updated_at')->default(date('Y-m-d H:i:s'));
            $table->timestamps();
            $table->softDeletes();
        });

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '帖子表'");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'posts';
        $dbConnection = config('modules.post.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
