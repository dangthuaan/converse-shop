<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsBanToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'is_ban')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_ban')->after('remember_token');
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
        if (Schema::hasColumn('users', 'is_ban')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_ban');
            });
        }
    }
}
