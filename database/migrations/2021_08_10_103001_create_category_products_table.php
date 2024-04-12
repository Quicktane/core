<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'category_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained($this->prefix.'categories');
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->integer('position')->default(1)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'category_products');
    }
};
