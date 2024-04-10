<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'attribute_group_attributes', function (Blueprint $table) {
            $table->foreignId('attribute_group_id')->constrained($this->prefix.'attribute_groups');
            $table->foreignId('attribute_id')->constrained($this->prefix.'attributes');

            $table->primary(['attribute_group_id', 'attribute_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'attribute_group_attributes');
    }
};
