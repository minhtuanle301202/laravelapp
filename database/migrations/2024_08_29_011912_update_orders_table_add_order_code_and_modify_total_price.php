<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_code')->after('id')->unique();
            $table->decimal('total_price', 15, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_code');
            $table->decimal('total_price', 10, 2)->change();
        });
    }
};
