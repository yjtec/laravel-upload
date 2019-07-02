<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_system', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename',255)->comment('文件名称');
            $table->string('mimetype',100)->comment('文件mimetype');
            $table->integer('filesize')->comment('文件大小');
            $table->string('extension',20)->comment('文件后缀名');
            $table->string('path',255)->comment('相对路径');
            $table->string('url',500)->comment('文件的url');
            $table->integer('foreign_key')->nullable()->default(0)->comment('文件关联的外部主键');
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
        Schema::dropIfExists('file_system');
    }
}
