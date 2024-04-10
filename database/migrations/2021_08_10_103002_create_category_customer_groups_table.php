<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'category_customer_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained($this->prefix.'categories');
            $table->foreignId('customer_group_id')->constrained($this->prefix.'customer_groups');
//            $this->scheduling($table);
            $table->boolean('visible')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'category_customer_groups');
    }
};
