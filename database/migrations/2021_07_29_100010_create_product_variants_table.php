<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'product_variants', function (Blueprint $table) {
            $table->foreignId('configurable_product_id')->constrained($this->prefix.'products');
            $table->foreignId('variant_id')->constrained($this->prefix.'products');

            $table->primary(['configurable_product_id', 'variant_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'product_variants');
    }
};
