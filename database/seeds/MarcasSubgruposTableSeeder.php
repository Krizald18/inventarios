<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class MarcasSubgruposTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('marca_subgrupo')->delete();

		$marca_subgrupo = array(
			array(
				'marca_id' => 1,
				'subgrupo_id' => 6,
				'created_at' => $now,
				),
			array(
				'marca_id' => 1,
				'subgrupo_id' => 20,
				'created_at' => $now,
				),
			array(
				'marca_id' => 5,
				'subgrupo_id' => 13,
				'created_at' => $now,
				),
			array(
				'marca_id' => 6,
				'subgrupo_id' => 13,
				'created_at' => $now,
				),
			array(
				'marca_id' => 7,
				'subgrupo_id' => 15,
				'created_at' => $now,
				),
			array(
				'marca_id' => 7,
				'subgrupo_id' => 23,
				'created_at' => $now,
				),
			array(
				'marca_id' => 8,
				'subgrupo_id' => 11,
				'created_at' => $now,
				),
			array(
				'marca_id' => 8,
				'subgrupo_id' => 21,
				'created_at' => $now,
				),
			array(
				'marca_id' => 11,
				'subgrupo_id' => 21,
				'created_at' => $now,
				),
			array(
				'marca_id' => 13,
				'subgrupo_id' => 20,
				'created_at' => $now,
				),
			array(
				'marca_id' => 15,
				'subgrupo_id' => 22,
				'created_at' => $now,
				),
			array(
				'marca_id' => 16,
				'subgrupo_id' => 1,
				'created_at' => $now,
				),
			array(
				'marca_id' => 16,
				'subgrupo_id' => 7,
				'created_at' => $now,
				),
			array(
				'marca_id' => 16,
				'subgrupo_id' => 10,
				'created_at' => $now,
				),
			array(
				'marca_id' => 16,
				'subgrupo_id' => 11,
				'created_at' => $now,
				),
			array(
				'marca_id' => 16,
				'subgrupo_id' => 12,
				'created_at' => $now,
				),
			array(
				'marca_id' => 16,
				'subgrupo_id' => 17,
				'created_at' => $now,
				),
			array(
				'marca_id' => 16,
				'subgrupo_id' => 18,
				'created_at' => $now,
				),
			array(
				'marca_id' => 16,
				'subgrupo_id' => 21,
				'created_at' => $now,
				),
			array(
				'marca_id' => 18,
				'subgrupo_id' => 7,
				'created_at' => $now,
				),
			array(
				'marca_id' => 20,
				'subgrupo_id' => 21,
				'created_at' => $now,
				),
			array(
				'marca_id' => 25,
				'subgrupo_id' => 13,
				'created_at' => $now,
				),
			array(
				'marca_id' => 25,
				'subgrupo_id' => 14,
				'created_at' => $now,
				),
			array(
				'marca_id' => 14,
				'subgrupo_id' => 17,
				'created_at' => $now,
				),
			array(
				'marca_id' => 21,
				'subgrupo_id' => 17,
				'created_at' => $now,
				),
			array(
				'marca_id' => 23,
				'subgrupo_id' => 1,
				'created_at' => $now,
				),
			array(
				'marca_id' => 24,
				'subgrupo_id' => 7,
				'created_at' => $now,
				),
			array(
				'marca_id' => 26,
				'subgrupo_id' => 11,
				'created_at' => $now,
				),
			array(
				'marca_id' => 27,
				'subgrupo_id' => 12,
				'created_at' => $now,
				),
			array(
				'marca_id' => 28,
				'subgrupo_id' => 13,
				'created_at' => $now,
				)
		);
		DB::table('marca_subgrupo')->insert($marca_subgrupo);
	}
}