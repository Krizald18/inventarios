<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class GruposTableSeeder extends Seeder {
	public function run() {
		$now = Carbon::now();
		//DB::table('grupos')->delete();

		$grupos = array(
			array(
				'id' => 1,
				'grupo' => 'Equipo de Computo',
				'created_at' => $now,
				),
			array(
				'id' => 2,
				'grupo' => 'Moviliario',
				'created_at' => $now,
				)
		);
		DB::table('grupos')->insert($grupos);
	}
}