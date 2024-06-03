<?php

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_purchase', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(Item::class)->constrained()->onUpdate('cascade');
        $table->foreignIdFor(Purchase::class)->constrained()->onUpdate('cascade');
        $table->integer('quantity');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_purchase');
    }
};
