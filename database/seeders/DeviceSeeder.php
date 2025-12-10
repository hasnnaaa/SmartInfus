<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() 
    {
        \App\Models\Device::create([
            'device_code' => 'KAMAR-MELATI-01', // Sesuaikan dengan ID di simulator Node.js
            'room_name' => 'RUANGAN MELATI 01',
            'device_name' => 'INFUSAN 01',
            'is_active' => true
        ]);
        
        \App\Models\Device::create([
            'device_code' => 'KAMAR-MAWAR-02',
            'room_name' => 'RUANGAN MAWAR 02',
            'device_name' => 'INFUSAN 02',
            'is_active' => false
        ]);
    }
}
