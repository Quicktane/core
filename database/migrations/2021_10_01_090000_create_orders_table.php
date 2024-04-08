<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Base\Migration;

return new class extends Migration {
    public function up()
    {
        Schema::create($this->prefix.'orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('customer_id')->nullable()->constrained($this->prefix.'customers');
            $table->foreignId('cart_id')->nullable()->constrained($this->prefix.'carts')->nullOnDelete();
            $table->foreignId('channel_id')->constrained($this->prefix.'channels');
            $table->string('status')->index();
            $table->string('reference')->nullable()->unique();
            $table->string('customer_reference')->nullable();
            $table->unsignedBigInteger('sub_total')->unsigned()->index();
            $table->unsignedBigInteger('discount_total')->default(0)->unsigned()->index();
            $table->unsignedBigInteger('shipping_total')->default(0)->unsigned()->index();
            $table->unsignedBigInteger('tax_total')->unsigned()->index();
            $table->unsignedBigInteger('total')->unsigned()->index();
            $table->text('notes')->nullable();
            $table->string('currency_code', 3);
            $table->json('tax_breakdown');
            $table->json('meta')->nullable();
            $table->dateTime('placed_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'orders');
    }
};
