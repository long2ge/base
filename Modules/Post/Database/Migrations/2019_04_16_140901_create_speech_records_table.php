<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeechRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'speech_records';
        $dbConnection = config('modules.post.config.db-connection');

        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('comment_id');
            $table->unsignedInteger('response_id')->default(0);
            $table->primary(['post_id', 'comment_id', 'response_id']);
        });

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '发言记录表'");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'speech_records';
        $dbConnection = config('modules.post.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
