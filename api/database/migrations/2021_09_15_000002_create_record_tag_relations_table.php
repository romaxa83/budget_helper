<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordTagRelationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('record_tag_relations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('record_id');
            $table->foreign('record_id')
                ->references('id')
                ->on('records')
                ->onDelete('cascade');

            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('record_tag_relations');
    }
}
