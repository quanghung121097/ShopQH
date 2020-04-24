<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('phone')->nullable();
            $table->integer('role')->default(1);
            $table->string('avatar')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->integer('sex')->default(1);
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone','role','avatar','provider','provider_id','sex','last_name','first_name','address']);
        });
    }
}
