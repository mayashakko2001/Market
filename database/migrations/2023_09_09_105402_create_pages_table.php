<?php

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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->longtext('image');
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
           
            $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete();
            $table->integer('count_products');
            $table->integer('saled_products');
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
        Schema::dropIfExists('pages');
    }
};
