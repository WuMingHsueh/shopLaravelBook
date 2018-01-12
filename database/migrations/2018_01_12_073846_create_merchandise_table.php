<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchandiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise', function (Blueprint $table) {
            $table->increments('id');

            $table->string('status', 1)->default('C');
            // 標記商品狀態，已上架才能被使用者看到
            // - C (create) : 建立中
            // - S (sell)   : 販售中

            $table->string('name', 80)->nullable();
            $table->string('name_en', 80)->nullable();
            $table->string('introduction');
            $table->string('introduction_en');
            $table->string('photo', 50)->nullable();
            $table->string('price')->default(0);
            $table->integer('remain_count')->defaulte(0);
            $table->timestamps();

            //索引建立
            $table->index(['status'], 'merchandise_status_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandise');
    }
}
