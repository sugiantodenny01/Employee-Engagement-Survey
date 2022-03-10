<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id');
            $table->string('name');
            $table->string('id_number');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->enum('role', ['head of division', 'staff']);
            $table->string('email');
            $table->string('password');
            $table->string('education');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->date('join_date');
            $table->string('avatar');
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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_division_id_foreign');
        });

        Schema::dropIfExists('employees');
    }
}
