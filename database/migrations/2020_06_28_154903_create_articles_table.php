<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * article details table
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('id');
            $table->string('title',50)->comment('标题')->nullable()->default('');
            $table->tinyInteger('type')->comment('文章内容 1、markdown 2、富文本')->nullable()->default(1);
            $table->integer('category')->comment('类别 10 文章，20 美食，30 好物 40 图片')->nullable()->default(10);
            $table->string('description',100)->comment('描述')->nullable()->default('');
            $table->string('key_words',20)->comment('关键词')->nullable()->default('');
            $table->string('cover_images',80)->comment('封面图')->nullable()->default('');
            $table->bigInteger('read_number')->comment('阅读数')->nullable()->default(0);
            $table->text('content')->comment('内容')->nullable();
            $table->index(['category']);
            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
}
