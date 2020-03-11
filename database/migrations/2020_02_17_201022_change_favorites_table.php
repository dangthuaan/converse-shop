<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('favorites', 'user_id')) {
            Schema::table('favorites', function (Blueprint $table) {
                $table->bigInteger('user_id')->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('favorites', 'user_id')) {
            Schema::table('favorites', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
}
