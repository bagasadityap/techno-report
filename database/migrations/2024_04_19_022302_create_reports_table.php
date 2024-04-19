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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('reporter');
            $table->text('detail');
            $table->date('date');
            $table->string('photo');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onUpdate('CASCADE');

            $table->unsignedBigInteger('authority_id');
            $table->foreign('authority_id')
                ->references('id')->on('authorities')
                ->onUpdate('CASCADE');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')
                ->references('id')->on('statuses')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
