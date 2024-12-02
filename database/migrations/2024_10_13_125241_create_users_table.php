<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name_en', 100);
            $table->string('name_bn', 100);
            $table->string('email', 100)->unique()->nullable();
            $table->string('username', 50)->unique();
            $table->string('mobile', 50)->unique();
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedTinyInteger('status')
                ->default(1)
                ->comment('1=active,2=inactive');
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
        Schema::dropIfExists('users');
    }
}
