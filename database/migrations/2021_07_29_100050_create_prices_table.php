<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_group_id')->nullable()->constrained($this->prefix.'customer_groups');
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->unsignedBigInteger('amount')->default(0);
            $table->foreignId('currency_id')->nullable()->constrained($this->prefix.'currencies');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'prices');
    }
};
