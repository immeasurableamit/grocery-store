<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_details', function (Blueprint $table) {
            $table->id();
            $table->string('store_title')->nullable();
            $table->string('store_url')->nullable();
            $table->string('store_logo')->nullable();
            $table->text('address1');
            $table->text('address2');
            $table->text('city');
            $table->text('country');
            $table->string('state');
            $table->integer('post_code');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('seller_type');
            $table->integer('user_id');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('store_details');
    }
}
