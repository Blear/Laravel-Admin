<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions',function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->smallInteger('sort')->default(0)->unsigned();
            $table->timestamps();
        });
        Schema::create('permission_role',function(Blueprint $table){
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_role',function(Blueprint $table){
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
    }
}
