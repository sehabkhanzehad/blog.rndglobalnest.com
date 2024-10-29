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
        Schema::create('cover_blogs', function (Blueprint $table) {
            $table->id();
            $table->integer("blog_id");
            // make relation with blog table
            // $table->foreign("blog_id")->references("id")->on("blogs")->onDelete("cascade");

            $table->enum('is_cover', ['cover1', 'cover2', 'cover3', 'cover4'])->default(null)->nullable();
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cover_blogs');
    }
};
