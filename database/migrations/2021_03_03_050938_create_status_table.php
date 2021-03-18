<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default('0');
            $table->string('name', 15)->unique()->nullable();
        });

        ( new \App\Models\Status([
            'status' => 1,
            'name' => 'На рассмотрении',
        ]))->save();

        ( new \App\Models\Status([
            'status' => 2,
            'name' => 'Активна',
        ]))->save();

        ( new \App\Models\Status([
            'status' => 3,
            'name' => 'Завершена',
        ]))->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status');
    }
}
