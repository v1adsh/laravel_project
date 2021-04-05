<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReviewRetingReviewFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_rating', function (Blueprint $table) {
            $table->foreign('review_id')->references('id')->on('review')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_rating', function (Blueprint $table) {
            $table->dropForeign(['review_id']);
        });
    }
}
