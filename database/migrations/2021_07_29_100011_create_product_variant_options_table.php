<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'product_variant_options', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->foreignId('option_id')->constrained($this->prefix.'attribute_options');

            $table->primary(['product_id', 'option_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'product_variant_options');
    }
};
