<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->integer('role')->default('0');
            $table->string('name', 15)->unique()->nullable();
        });

        ( new \App\Models\Role([
            'role' => 1,
            'name' => 'guest',
        ]))->save();

        ( new \App\Models\Role([
            'role' => 2,
            'name' => 'user',
        ]))->save();

        ( new \App\Models\Role([
            'role' => 3,
            'name' => 'admin',
        ]))->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
