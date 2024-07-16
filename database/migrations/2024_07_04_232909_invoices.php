<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('week_id');
            $table->string('yacht_name');
            $table->string('location');
            $table->string('email');
            $table->string('date');
            $table->string('due_date');
            $table->text('notes')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
            $table->foreign('week_id')->references('id')->on('weeks')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
