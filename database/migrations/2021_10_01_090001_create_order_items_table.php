<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained($this->prefix.'orders');
            $table->morphs('item');
            $table->string('description');
            $table->string('option')->nullable();
            $table->string('identifier')->index();
            $table->unsignedBigInteger('unit_price')->unsigned()->index();
            $table->unsignedInteger('unit_quantity')->default(1)->unsigned()->index();
            $table->unsignedInteger('quantity')->unsigned();
            $table->unsignedBigInteger('sub_total')->unsigned()->index();
            $table->unsignedBigInteger('discount_total')->default(0)->unsigned()->index();
            $table->unsignedBigInteger('tax_total')->unsigned()->index();
            $table->unsignedBigInteger('total')->unsigned()->index();
            $table->text('notes')->nullable();
            $table->json('tax_breakdown');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'order_items');
    }
};
