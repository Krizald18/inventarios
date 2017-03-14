<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class MarcasSubgruposTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('marca_subgrupo')->delete();

		$marca_subgrupo = array(
			array(
				'marca_id' => 1, // 3COM
				'subgrupo_id' => 9,
				'created_at' => $now,
				),
			array(
				'marca_id' => 1, // 3COM
				'subgrupo_id' => 15,
				'created_at' => $now,
				),
			array(
				'marca_id' => 1, // 3COM
				'subgrupo_id' => 20,
				'created_at' => $now,
				),
			array(
				'marca_id' => 8, // CISCO
				'subgrupo_id' => 9,
				'created_at' => $now,
				),
			array(
				'marca_id' => 8, // CISCO
				'subgrupo_id' => 15,
				'created_at' => $now,
				),
			array(
				'marca_id' => 8, // CISCO
				'subgrupo_id' => 20,
				'created_at' => $now,
				),
			array(
				'marca_id' => 2, // ACER
				'subgrupo_id' => 1,
				'created_at' => $now,
				),
			array(
				'marca_id' => 2, // ACER
				'subgrupo_id' => 2,
				'created_at' => $now,
				),
			array(
				'marca_id' => 9, // COMPAQ
				'subgrupo_id' => 1,
				'created_at' => $now,
				),
			array(
				'marca_id' => 9, // COMPAQ
				'subgrupo_id' => 2,
				'created_at' => $now,
				),
			array(
				'marca_id' => 11, // DELL
				'subgrupo_id' => 1,
				'created_at' => $now,
				),
			array(
				'marca_id' => 11, // DELL
				'subgrupo_id' => 2,
				'created_at' => $now,
				),
			array(
				'marca_id' => 15, // EPSON
				'subgrupo_id' => 7,
				'created_at' => $now,
				),
			array(
				'marca_id' => 17, // HP
				'subgrupo_id' => 1,
				'created_at' => $now,
				),
			array(
				'marca_id' => 17, // HP
				'subgrupo_id' => 2,
				'created_at' => $now,
				),
			array(
				'marca_id' => 17, // HP
				'subgrupo_id' => 7,
				'created_at' => $now,
				),
			array(
				'marca_id' => 17, // HP
				'subgrupo_id' => 10,
				'created_at' => $now,
				),
			array(
				'marca_id' => 17, // HP
				'subgrupo_id' => 11,
				'created_at' => $now,
				)
		);
		DB::table('marca_subgrupo')->insert($marca_subgrupo);
	}
}