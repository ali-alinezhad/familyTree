<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
            $table->string('english_name');
            $table->string('persian_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('role')->default(2);
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        User::firstOrCreate(
            [
                'english_name' => 'Shahab Espahbodi',
                'persian_name' => 'Shahab Espahbodi',
                'username'     => 'shahab.espahbodi1',
                'password'     => Hash::make(12345678),
            ]
        );

        $user = User::find(1);
        $user->role = 0;
        $user->save();
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
