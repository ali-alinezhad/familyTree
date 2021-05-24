<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->date('birthday');
            $table->string('birthday_place');
            $table->string('residence_place');
            $table->string('education');
            $table->string('job_title')->nullable();
            $table->string('job_place')->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('spouse_name')->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('marriage_place')->nullable();
            $table->integer('children_number')->nullable();
            $table->string('titles')->nullable();
            $table->integer('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('picture')->nullable();
            $table->date('death_date')->nullable();
            $table->string('death_place')->nullable();
            $table->string('burial_place')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('profile');
    }
}
