<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class ModelosTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('modelos')->delete();
		// datos de prueba
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [1,17,'LASERJET 1100 / 1100A', 20, 7, $now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [2,17,'LASERJET 1200', 19, 7, $now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [3,15,'L220', 18, 7, $now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [4,9,'6200 CORE', 17, 1, $now]);
		DB::insert('insert into modelos (id, marca_id, modelo, caracteristica_id, subgrupo_id, created_at) values (?,?,?,?,?,?)', [5,17,'PAVILION 14-E015LA', 16, 10, $now]);

		/*
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [1,'1100',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [2,'1200',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [3,'2035',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [4,'6005',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [5,'8100',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [6,'1000 WATTS',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [7,'1520',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [8,'1811/K9',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [9,'1PD8899A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [10,'2300',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [11,'2410MA',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [12,'2420DN',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [13,'2420N',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [14,'280 VA',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [15,'3005N',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [16,'3105',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [17,'3300',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [18,'3C-17206',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [19,'4050N',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [20,'405MT',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [21,'4199',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [22,'4222',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [23,'42KC',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [24,'480VA',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [25,'500VA',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [26,'54',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [27,'5502',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [28,'6535B',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [29,'7911',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [30,'7911F',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [31,'7911G',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [32,'BP 2884',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [33,'B-SMART706',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [34,'C2828A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [35,'C4224A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [36,'C422MA',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [37,'C5D1E-T02',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [38,'C7044A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [39,'C7063A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [40,'C7710A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [41,'CENTRA 500',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [42,'CRT',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [43,'D220',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [44,'D2828A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [45,'D288A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [46,'D8181A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [47,'DC5700',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [48,'DC5850',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [49,'DC7600',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [50,'DIGITAL 7540',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [51,'DN-21-102',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [52,'DX2000',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [53,'ENH908',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [54,'EVO',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [55,'EVO D220',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [56,'FS-1200',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [57,'G650B',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [58,'KB-0133',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [59,'KB-5926',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [60,'KB-9970',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [61,'KT-412875',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [62,'KT-4128TS',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [63,'L1710',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [64,'LASER 1200',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [65,'LASER 1200',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [66,'LASERJET',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [67,'LASERJET 1100',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [68,'LASERJET 1200',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [69,'MICRO-SEA',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [70,'MS34',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [71,'M-S34',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [72,'M-S48',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [73,'OFFICE 500VA 300W',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [74,'OFFICECONNECT',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [75,'P.III',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [76,'P2015',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [77,'P2035',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [78,'P3005',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [79,'P30055',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [80,'P7740A',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [81,'PC 500',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [82,'PS7000',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [83,'RT-4128TS',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [84,'RT9410',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [85,'S1933',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [86,'S7540',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [87,'SK-1688',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [88,'SR2000',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [89,'SR480',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [90,'SR480VA',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [91,'SRINET 480',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [92,'UNIFIED IP PHONE 7941',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [93,'VCDTS21384-IM',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [94,'VECTRA',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [95,'VL420',$now]);
		DB::insert('insert into modelos (id, marca, modelo, created_at) values (?,?,?,?)', [96,'W1952A',$now]);
		*/
	}
}