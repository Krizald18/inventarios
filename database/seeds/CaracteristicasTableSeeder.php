<?php

use Illuminate\Database\Seeder;
use \Carbon\Carbon;

class CaracteristicasTableSeeder extends Seeder {
	public function run(){
		$now = Carbon::now();
		DB::table('caracteristicas')->delete();

		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [1,'SATA-300, 2 GB RAM DDR3, AMD Athlon II X2 B24 / 3 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [2,'COLOR 4800 x 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [3,'SATA-600, 4 GB RAM DDR3, AMD A series A4-5000 / 1.5 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [4,'15" CTR 1024 x 768 @ 60 Hz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [5,'80GB HDD, 512MB RAM, Pentium 4 / 2.8GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [6,'SATA-300, 2 GB RAM DDR2, AMD Athlon 64 X2 4450B / 2.3 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [7,'SATA-300, 1 GB RAM DDR2, Intel Pentium 4 640 / 3.2 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [8,'ATA-100, 256 MB RAM, Intel Celeron D 320 / 2.4 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [9,'ATA-100, 128 MB RAM, Intel Pentium 4 / 1.8 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [10,'ATA-100, 512 MB RAM, Intel Pentium 4 / 2.8 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [11,'17" TFT LCD',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [12,'x4 SATA, x16 RAM DIMM, 2 CPU / 2.0 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [13,'ATA-66 20GB, 128MB SDRAM, Intel® Pentium® III / 1000MHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [14,'ATA-100, PC-133 SDRAM, Pentium 4 / 2.4 GHz (Socket 478)',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [15,'Toner, Laser, 8 ppm, 600 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [16,'Toner, Laser, 15 ppm, 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [17,'Toner, Laser, 30 ppm, 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [18,'Toner, Laser, 28 ppm, 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [19,'Toner, Laser, 17 ppm, 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [20,'Toner, Laser, 33 ppm, 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [21,'Toner, Laser, 19 ppm, 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [22,'Toner, Laser, 25 ppm, 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [23,'SATA-300, 1 GB RAM DDR2, Intel Pentium 4 641 / 3.2 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [24,'Toner, Laser, 26 ppm, 1200 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [25,'19.5" LCD 1440 x 900 @ 60 Hz ',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [26,'18.5" LCD 1366 x 768 @ 60 Hz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [27,'18.5" LCD Iluminación de fondo LED 1366 x 768 @ 60 Hz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [28,'Color blanco, conector PS/2, sistema mecanico rueda',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [29,'Color negro con gris, conector PS/2, sistema mecanico rueda',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [30,'Color gris, conector PS/2, sistema mecanico rueda',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [31,'Protección 37 min, capacidad 2000 va, 6 contactos',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [32,'Protección 25 min, capacidad 480 va, 4 contactos',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [33,'4 CONTACTOS 1000 VA',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [34,'4 CONTACTOS 2000 VA',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [35,'4 CONTACTOS 500 VA',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [36,'VGA 600 dpi x 2400 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [37,'600 dpi ',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [38,'SCSI, USB tipo B, 2400 dpi x 2400 dpi',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [39,'Color negro con gris, conector PS/2',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [40,'Color blanco, conector PS/2',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [41,'Color gris, conector PS/2',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [42,'Color gris, conector PS/2, con teclas de navegación',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [43,'Color gris, SCCP, IEEE 802.1Q (VLAN), IEEE 802.1p',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [44,'Color gris, SCCP, IEEE 802.1Q (VLAN), IEEE 802.1p, TFTP',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [45,'15" LCD 1024 x 768 at 75 Hz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [46,'15" CRT',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [47,'15"',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [48,'17" CRT',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [49,'4 CONTACTOS 500 VA, COLOR NEGRO, CON DISPLAY',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [50,'5 CONTACTOS 700 VA',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [51,'8 PUERTOS 10/100MBPS',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [52,'8 PUERTOS, COLOR BLANCO',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [53,'COLOR BLANCO ANALOGICO',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [54,'Protección 10 min, capacidad 500 VA, 4 contactos',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [55,'TERMICA',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [56,'DISLAY GRAFICO, ANALOGICO',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [57,'DUAL ETHERNET SECURITY ROUTER CON V.92 MODEM BACKUP',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [58,'Toner, Laser, 12 ppm',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [59,'SATA-300, 2 GB DDR2, AMD Athlon 64 X2 QL-64 / 2.1 GHz',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [60,'24 PUERTOS 10/100Mbps',$now]);
		DB::insert('insert into caracteristicas (id, caracteristica, created_at) values (?,?,?)', [61,'Ultra160 SCSI, PC133, Intel Pentium 4  / 1.7 GHz',$now]);
	}
}