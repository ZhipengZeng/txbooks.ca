<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialusers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('avatar');
            $table->string('provider');
            $table->string('provider_id')->unique();
            $table->boolean('admin')->default(0);
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socialusers');
    }
}
