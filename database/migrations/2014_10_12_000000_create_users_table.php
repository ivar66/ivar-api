<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * user
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('真实姓名')->default('');
            $table->string('nick_name',20)->comment('昵称')->default('');
            $table->string('phone',15)->unique()->comment('手机号');
            $table->string('avatar',80)->comment('头像')->nullable()->default('');
            $table->string('description',100)->comment('简介')->nullable()->default('');
            $table->string('email')->nullable()->default('')->comment('邮箱');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
