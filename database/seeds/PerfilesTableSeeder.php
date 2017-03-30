<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class PerfilesTableSeeder extends Seeder {
	public function run() {
		$now = Carbon::now();
		DB::table('perfiles')->delete();
		DB::insert('insert into perfiles (id, perfil, created_at) values (?, ?, ?)', [1,'admin',$now]);
	}
}