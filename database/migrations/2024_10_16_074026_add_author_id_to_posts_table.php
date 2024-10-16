<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorIdToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable()->after('id'); // Tambahkan kolom author_id
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null'); // Tambahkan foreign key
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']); // Hapus foreign key
            $table->dropColumn('author_id'); // Hapus kolom author_id
        });
    }
}
