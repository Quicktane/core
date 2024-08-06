<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'attribute_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained($this->prefix.'attributes');
            $table->string('name');
            $table->string('slug');
            $table->boolean('default')->default(false);
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'attribute_options');
    }
};
