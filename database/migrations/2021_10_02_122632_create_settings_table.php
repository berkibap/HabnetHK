<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hk_settings', function (Blueprint $table) {
            $table->string("key");
            $table->string("value");
            $table->integer("last_updated_by")->default(0);
        });
        DB::table("hk_settings")->insert(array(
            'key' => 'min_rank',
            'value' => 4
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hk_settings');
    }
}
