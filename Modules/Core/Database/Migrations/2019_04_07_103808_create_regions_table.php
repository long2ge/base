<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Core\Database\Seeders\RegionTableSeederTableSeeder;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = 'regions';
        $dbConnection = config('modules.core.config.db-connection');
        Schema::connection($dbConnection)->create($table, function (Blueprint $table) {
            $table->integer('id')->comment('行政编码');
            $table->string('name')->comment('省市区名');
            $table->integer('pid')->comment('父级编码');
            $table->string('capital')->comment('拼音首字母');
            $table->string('abbr')->comment('拼音全拼');
            $table->smallInteger('level')->comment('等级');
            $table->tinyInteger('enable')->comment('是否启用 1启用， 0不启用');
        });

        DB::connection($dbConnection)->statement("ALTER TABLE `$table` comment '地区表'");

        app(RegionTableSeederTableSeeder::class)->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = 'regions';
        $dbConnection = config('modules.core.config.db-connection');
        Schema::connection($dbConnection)->dropIfExists($table);
    }
}
