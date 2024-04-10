<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Base\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->prefix.'products', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index();
            $table->string('sku')->nullable()->index();
            $table->string('gtin')->nullable()->index();
            $table->string('mpn')->nullable()->index();
            $table->string('ean')->nullable()->index();
            $table->string('status')->index();
            $table->integer('quantity')->default(0)->index();
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
        Schema::dropIfExists($this->prefix.'products');
    }
}
