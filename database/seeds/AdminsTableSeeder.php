<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
			DB::table('admins')->insert([
				'id' => 1,
				'email' => 'admin@email.com',
				'password' => bcrypt('test1234'),
				'name' => '管理者アカウント',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			]);
		}
}
