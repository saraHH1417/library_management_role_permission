<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name' , 255);
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('publisher_id');

            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('publisher_id')
                ->references('id')
                ->on('publishers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
