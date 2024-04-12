<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'customer_group_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_group_id')->constrained($this->prefix.'customer_groups');
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->boolean('visible')->default(true)->index();
            $table->boolean('purchasable')->default(true)->index();

            $this->scheduling($table);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'customer_group_product');
    }
};
