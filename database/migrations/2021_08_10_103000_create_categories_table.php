<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_group_id')->constrained($this->prefix.'category_groups');
            $table->nestedSet();
//            $table->string('type')->default('static')->index();
            $table->integer('position')->default(1)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'categories');
    }
};
