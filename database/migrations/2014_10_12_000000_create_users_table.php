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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->unsignedBigInteger('division_id');
            $table->string('id_number');
            $table->enum('gender', ['male', 'female']);
            $table->enum('role', ['director', 'head of division', 'staff']);
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();

            $table->foreign('division_id')->references('id')->on('divisions');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('users', function (Blueprint $table) {
//            $table->dropForeign('users_division_id_foreign');
//        });

        Schema::dropIfExists('users');
    }
}
