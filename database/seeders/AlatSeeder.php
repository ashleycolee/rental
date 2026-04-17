<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = Kategori::pluck('idkategori', 'namakategori')->toArray();

        $kategoriNames = [
            'Komputer & Laptop',
            'Kamera & Fotografi', 
            'Audio & Video',
            'Alat Kantor',
            'Olahraga & Outdoor',
            'Lab Elektronika',
            'Lab Kimia',
            'Alat Mekanik'
        ];

        $alatData = [
            // Komputer & Laptop (idkategori 1)
            [
                'namaalat' => 'Laptop Dell XPS 13',
                'spesifikasi' => 'Intel Core i7-1360P, RAM 16GB, SSD 512GB, Intel Iris Xe Graphics, 13.4" FHD+',
                'gambaralat' => 'dell-xps13.jpg',
                'qty' => 5
            ],
            [
                'namaalat' => 'MacBook Air M2',
                'spesifikasi' => 'Apple M2 Chip, RAM 8GB, SSD 256GB, 13.6" Retina Display, macOS Ventura',
                'gambaralat' => 'macbook-air-m2.png',
                'qty' => 3
            ],
            [
                'namaalat' => 'Lenovo ThinkPad T14',
                'spesifikasi' => 'AMD Ryzen 5 5625U, RAM 16GB, SSD 512GB, 14" FHD, Windows 11 Pro',
                'gambaralat' => 'thinkpad-t14.jpg',
                'qty' => 4
            ],
            [
                'namaalat' => 'HP Pavilion Gaming',
                'spesifikasi' => 'Intel Core i5-12450H, RAM 16GB, RTX 3050 4GB, SSD 512GB, 15.6" FHD 144Hz',
                'gambaralat' => 'hp-pavilion-gaming.jpg',
                'qty' => 2
            ],

            // Kamera & Fotografi (idkategori 2)
            [
                'namaalat' => 'Canon EOS R6',
                'spesifikasi' => 'Full Frame Mirrorless, 20.1MP, 4K 60fps, Dual Pixel AF, RF Mount',
                'gambaralat' => 'canon-eos-r6.jpg',
                'qty' => 2
            ],
            [
                'namaalat' => 'Sony A7 III',
                'spesifikasi' => 'Full Frame Mirrorless, 24.2MP, 4K 30fps, 693-point AF, 5-axis IBIS',
                'gambaralat' => 'sony-a7iii.jpg',
                'qty' => 3
            ],
            [
                'namaalat' => 'DJI Osmo Pocket 3',
                'spesifikasi' => '1" CMOS Sensor, 4K 120fps, 3-axis Gimbal, 2" Rotating Touchscreen',
                'gambaralat' => 'dji-osmo-pocket3.jpg',
                'qty' => 4
            ],
            [
                'namaalat' => 'Nikon Z50',
                'spesifikasi' => 'APS-C Mirrorless, 20.9MP, 4K UHD, 209-point Hybrid AF, Z Mount',
                'gambaralat' => 'nikon-z50.jpg',
                'qty' => 1
            ],

            // Audio & Video (idkategori 3)
            [
                'namaalat' => 'Rode NT1 5th Gen',
                'spesifikasi' => 'Large-diaphragm Condenser Mic, USB/XLR, 32-bit Float, DSP Processing',
                'gambaralat' => 'rode-nt1-5th.jpg',
                'qty' => 6
            ],
            [
                'namaalat' => 'Shure SM7B',
                'spesifikasi' => 'Dynamic Vocal Mic, Cardioid, Built-in Pop Filter, XLR Connection',
                'gambaralat' => 'shure-sm7b.jpg',
                'qty' => 8
            ],
            [
                'namaalat' => 'Yamaha MG10XU Mixer',
                'spesifikasi' => '10-channel Analog Mixer, USB Interface, D-PRE Preamps, Effects',
                'gambaralat' => 'yamaha-mg10xu.jpg',
                'qty' => 3
            ],
            [
                'namaalat' => 'JBL EON ONE Compact',
                'spesifikasi' => 'Battery-powered PA, 12" Woofer, Bluetooth, App Control, 12h Battery',
                'gambaralat' => 'jbl-eon-one.jpg',
                'qty' => 2
            ],

            // Alat Kantor (idkategori 4)
            [
                'namaalat' => 'Epson L3250 Ink Tank',
                'spesifikasi' => 'All-in-One Ink Tank Printer, Print/Scan/Copy, WiFi, 33ppm B/W',
                'gambaralat' => 'epson-l3250.jpg',
                'qty' => 7
            ],
            [
                'namaalat' => 'Canon imageCLASS MF3010',
                'spesifikasi' => 'Laser Printer/Scanner/Copier, 19ppm, USB 2.0, 150-sheet Tray',
                'gambaralat' => 'canon-mf3010.jpg',
                'qty' => 4
            ],
            [
                'namaalat' => 'Paper Shredder Fellowes',
                'spesifikasi' => 'Cross-cut Shredder, 10-sheet Capacity, 23L Bin, Auto Start/Stop',
                'gambaralat' => 'fellowes-shredder.jpg',
                'qty' => 12
            ],

            // Olahraga & Outdoor (idkategori 5)
            [
                'namaalat' => 'Garmin Forerunner 265',
                'spesifikasi' => 'GPS Smartwatch, AMOLED 1.3", Music Storage, HRV Status, 13 days Battery',
                'gambaralat' => 'garmin-forerunner265.jpg',
                'qty' => 5
            ],
            [
                'namaalat' => 'Drone DJI Mini 3',
                'spesifikasi' => '<249g, 4K HDR Video, 34min Flight, 12MP Still, Transmission 10km',
                'gambaralat' => 'dji-mini3.jpg',
                'qty' => 1
            ],
            [
                'namaalat' => 'Action Camera GoPro HERO11',
                'spesifikasi' => '5.3K 60fps, HyperSmooth 5.0, 10m Waterproof, Enduro Battery',
                'gambaralat' => 'gopro-hero11.jpg',
                'qty' => 3
            ],

            // Lab Elektronika (idkategori 6)
            [
                'namaalat' => 'Oscilloscope Rigol DS1054Z',
                'spesifikasi' => '100MHz 4ch DSO, 1GSa/s, 24Mpts Memory, Serial Trigger/Decode',
                'gambaralat' => 'rigol-ds1054z.jpg',
                'qty' => 2
            ],
            [
                'namaalat' => 'Multimeter Fluke 117',
                'spesifikasi' => 'True RMS, Non-contact Voltage, Auto-ranging, CAT III 600V',
                'gambaralat' => 'fluke-117.jpg',
                'qty' => 10
            ],
            [
                'namaalat' => 'Soldering Station Hakko FX-888D',
                'spesifikasi' => '70W, 50-480°C, Digital Display, Sleep Mode, Quick Change Tips',
                'gambaralat' => 'hakko-fx888d.jpg',
                'qty' => 15
            ],
            [
                'namaalat' => 'Power Supply GW Instek GPS-4303',
                'spesifikasi' => '3ch Linear DC, 0-30V/0-3A x2 + 5V/3A, 195W, Digital Control',
                'gambaralat' => 'gw-instek-gps4303.jpg',
                'qty' => 4
            ],

            // Lab Kimia (idkategori 7)
            [
                'namaalat' => 'Mikroskop Olympus CX23',
                'spesifikasi' => 'Binokuler LED, Plan Achromat 4x/10x/40x/100x, Mechanical Stage',
                'gambaralat' => 'olympus-cx23.jpg',
                'qty' => 3
            ],
            [
                'namaalat' => 'pH Meter Hanna HI98130',
                'spesifikasi' => 'Waterproof Checker, ±0.05 pH Accuracy, Auto Calibration, 1-14 pH',
                'gambaralat' => 'hanna-hi98130.jpg',
                'qty' => 8
            ],
            [
                'namaalat' => 'Magnetic Stirrer',
                'spesifikasi' => 'Digital Speed Control, 100-2000rpm, LED Display, PT100 Probe',
                'gambaralat' => 'magnetic-stirrer.jpg',
                'qty' => 6
            ],
            [
                'namaalat' => 'Digital Scale 0.01g',
                'spesifikasi' => '200g/0.01g Capacity, Tare, PCS Mode, RS232 Interface',
                'gambaralat' => 'digital-scale.jpg',
                'qty' => 12
            ],

            // Alat Mekanik (idkategori 8)
            [
                'namaalat' => 'Digital Caliper Mitutoyo',
                'spesifikasi' => '0-150mm/0.01mm, ABS/INC Mode, Data Output, IP67 Waterproof',
                'gambaralat' => 'mitutoyo-caliper.jpg',
                'qty' => 9
            ],
            [
                'namaalat' => 'Cordless Drill DeWalt DCD791',
                'spesifikasi' => '20V MAX XR, 60Nm Torque, Brushless, 2-Speed, LED Light',
                'gambaralat' => 'dewalt-dcd791.jpg',
                'qty' => 7
            ],
            [
                'namaalat' => 'Angle Grinder Bosch GWS 9-125S',
                'spesifikasi' => '900W, 115mm Disc, Variable Speed, Spindle Lock, Restart Protection',
                'gambaralat' => 'bosch-gws9.jpg',
                'qty' => 5
            ]
        ];

        foreach ($alatData as $index => $data) {
            $kategoriIndex = $index % count($kategoriNames);
            $namaKategori = $kategoriNames[$kategoriIndex];

            Alat::create([
                'idkategori' => $kategoris[$namaKategori],
                'namaalat' => $data['namaalat'],
                'spesifikasi' => $data['spesifikasi'],
                'gambaralat' => $data['gambaralat'],
                'qty' => $data['qty']
            ]);
        }
    }
}

