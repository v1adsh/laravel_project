<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_rating', function (Blueprint $table) {
            $table->id();
            $table->integer('estimation')->default('0');
            $table->string('name', 15)->unique()->nullable();
        });

        (new \App\Models\ReviewRating([
            'estimation' => 1,
            'name' => 'bad',
        ]))->save();

        (new \App\Models\ReviewRating([
            'estimation' => 2,
            'name' => 'good',
        ]))->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_rating');
    }
}
