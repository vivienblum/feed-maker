<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AtlerTableImagesAddRgb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->json('colors')->nullable()->after('url');
            $table->unsignedTinyInteger('dominant_blue')->nullable()->after('url');
            $table->unsignedTinyInteger('dominant_green')->nullable()->after('url');
            $table->unsignedTinyInteger('dominant_red')->nullable()->after('url');
            $table->unsignedTinyInteger('average_blue')->nullable()->after('url');
            $table->unsignedTinyInteger('average_green')->nullable()->after('url');
            $table->unsignedTinyInteger('average_red')->nullable()->after('url');

            $table->index('dominant_blue');
            $table->index('dominant_green');
            $table->index('dominant_red');
            $table->index('average_blue');
            $table->index('average_green');
            $table->index('average_red');

            $table->dropColumn('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('colors');
            $table->dropColumn('dominant_blue');
            $table->dropColumn('dominant_green');
            $table->dropColumn('dominant_red');
            $table->dropColumn('average_blue');
            $table->dropColumn('average_green');
            $table->dropColumn('average_red');

            $table->string('color', 7)->nullable();
        });
    }
}
