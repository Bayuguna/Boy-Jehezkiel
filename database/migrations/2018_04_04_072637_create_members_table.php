<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('members', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('steamid');
			$table->string('email')->unique();
			$table->string('phonenumber');
			$table->string('address');
			$table->integer('teamid');
			$table->string('avatar')->default('default.jpg');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('members');
	}
}
