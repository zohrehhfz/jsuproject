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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('from');
			$table->foreign('from')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('travel_id');
			$table->foreign('travel_id')->references('id')->on('travels')->cascadeOnDelete();

            $table->unsignedBigInteger('parent_id')->nullable();
			$table->foreign('parent_id')->references('id')->on('users')->cascadeOnDelete();

            $table->boolean("flag")->default(false);

            $table->text('message');
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
        Schema::dropIfExists('chats');
    }
};
