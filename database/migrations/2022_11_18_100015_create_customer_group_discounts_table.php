<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'customer_group_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained($this->prefix.'discounts');
            $table->foreignId('customer_group_id')->constrained($this->prefix.'customer_groups');
            $this->scheduling($table);
            $table->boolean('visible')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'customer_group_discounts');
    }
};
