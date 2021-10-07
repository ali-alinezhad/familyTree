<?php

use App\Model\Homepage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage', function (Blueprint $table) {
            $table->id();
            $table->text('header_title')->nullable();
            $table->longText('header_des')->nullable();
            $table->mediumText('about_us_title')->nullable();
            $table->longText('about_us_des')->nullable();
            $table->string('logo')->default('images/logo/logo.jpg');
            $table->string('music')->nullable();
            $table->timestamps();
        });

        Homepage::firstOrCreate(
            [
                'header_title'   => 'Family Tree',
                'header_des'     => 'Family Tree',
                'about_us_title' => 'About Us',
                'about_us_des'   => 'This is our family',
                'logo'           => 'images/logo/logo.jpg',
            ]
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homepage');
    }
}
