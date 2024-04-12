<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Quicktane\Core\Base\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create($this->prefix.'tax_zone_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_zone_id')->constrained($this->prefix.'tax_zones');
            $table->foreignId('country_id')->constrained($this->prefix.'countries');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->prefix.'tax_zone_countries');
    }
};
