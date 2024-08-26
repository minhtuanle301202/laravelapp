<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublishedDateToNewsTable extends Migration
{
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->timestamp('published_date')->nullable(); // Thêm trường published_date
        });
    }

    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('published_date');
        });
    }
}
