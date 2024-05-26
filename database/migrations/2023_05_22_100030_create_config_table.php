<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'configs', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'config');
    }
};
