<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		  Schema::table ('users', function (Blueprint $table) {
            $table->tinyInteger ('active' )->default (0);
            $table->tinyInteger ('pending' )->default (0);
          });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table ('users', function (Blueprint $table) {
            $table->dropColumn ('active');
             $table->dropColumn ('pending');
          });
	}

}
