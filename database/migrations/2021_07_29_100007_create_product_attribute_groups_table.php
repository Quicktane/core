<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'product_attribute_groups', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->foreignId('attribute_group_id')->constrained($this->prefix.'attribute_groups');

            $table->primary(['product_id', 'attribute_group_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'product_attribute_groups');
    }
};
