<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class TiposTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('tipos')->delete();
		DB::insert('insert into tipos (id, tipo, created_at) values (?, ?, ?)', [1,'8100',$now]);
		DB::insert('insert into tipos (id, tipo, created_at) values (?, ?, ?)', [2,'BAJA',$now]);
		DB::insert('insert into tipos (id, tipo, created_at) values (?, ?, ?)', [3,'C',$now]);
		DB::insert('insert into tipos (id, tipo, created_at) values (?, ?, ?)', [4,'ULTIMAS 4',$now]);
	}
}