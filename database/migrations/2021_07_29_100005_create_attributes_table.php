<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->index();
            $table->boolean('required')->default(false);
            $table->string('default_value')->nullable();
            $table->boolean('system')->default(false);
            $table->boolean('searchable')->default(true)->index();
            $table->boolean('filterable')->default(false)->index();
            $table->integer('position')->index()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'attributes');
    }
};
