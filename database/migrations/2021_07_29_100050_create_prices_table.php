<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_group_id')->nullable()->constrained($this->prefix.'customer_groups');
            $table->foreignId('currency_id')->nullable()->constrained($this->prefix.'currencies');
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->unsignedBigInteger('price')->change();
            $table->unsignedBigInteger('compare_price')->change();
            $table->integer('tier')->default(1)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'prices');
    }
};
