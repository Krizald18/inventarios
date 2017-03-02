<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class CaracteristicasTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('caracteristicas')->delete();
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [1,'1100',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [2,'(DONADA)',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [3,'(INCLUYE MOUSE) SIN MULTILINEA',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [4,'8 PTOS. AUTOSENSING 10/100MBPS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [5,'8 PUERTOS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [6,'ANALOGICO',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [7,'ARMADO',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [8,'C/CONEXION Y FUENTE DE PODER C/M.O',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [9,'C/REGULADOR DE VOLTAJE INTEGRADO 4 CONTACTOS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [10,'CDP',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [11,'DE 4 CONTACTOS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [12,'DE 5 CONTACTOS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [13,'DE CONTACTOS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [14,'DE TURNOS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [15,'DE VOZ/IP',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [16,'DIALOG',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [17,'DUAL ETHERNET SECURITY ROUTER CON V.92 MODEM BACKUP',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [18,'ECOSYS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [19,'GT 10000',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [20,'HPLASERJET',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [21,'INTEL PENTIUM D 925, 512RAM, DISCO DURO DE 80GB, FLOPPY, DRW/48X',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [22,'IP',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [23,'LAP TOP',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [24,'LASEJET',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [25,'LASER',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [26,'LASER 1100',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [27,'LASERJET',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [28,'LASERJET 1100',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [29,'LASERJET 1200',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [30,'LASERJET 2200',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [31,'LASERJET 2200 DN',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [32,'LASERJET PRINTER',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [33,'LASERJET PRINTER VELOCIDAD DE IMPRESION DE 35PPM',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [34,'MONITOR 14" VGA MONOCROMATICO',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [35,'MONITOR 15"',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [36,'MONITOR A COLOR HP-54 DE 15"',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [37,'MONITOR DE 14"',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [38,'MONITOR DE 15"',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [39,'MONITOR DE 17"',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [40,'P/SERVIDOR',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [41,'PROCESADOR INTEL PENTIUM, MEMORIA RAM DE 512MB, DISCO DURO DE 80GB, UNIDAD DE CD-RW, WINDO WS XP PROFESIONAL',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [42,'SWITCH HUP 4400 DE 24 PUERTOS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [43,'T.C. 2110',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [44,'T.C. 2111',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [45,'T.C. 2112',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [46,'T.C. 2113',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [47,'T.C. 2114',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [48,'T.C. 2115',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [49,'T.C. 2116',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?, ?, ?)', [50,'TERMICA',$now]);
	}
}