<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'product_attributes', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->foreignId('attribute_id')->constrained($this->prefix.'attributes');

            $table->primary(['product_id', 'attribute_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'product_attributes');
    }
};
