<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('parent_transaction_id')->nullable()->constrained($this->prefix.'transactions');
            $table->foreignId('order_id')->constrained($this->prefix.'orders');
            $table->string('type')->index();
            $table->boolean('success')->index();
            $table->string('driver');
            $table->integer('amount')->unsigned()->index();
            $table->string('reference')->index();
            $table->string('status');
            $table->string('notes')->nullable();
            $table->string('card_type', 25)->index();
            $table->string('last_four', 4)->nullable();
            $table->dateTime('captured_at')->nullable()->index();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'transactions');
    }
};
