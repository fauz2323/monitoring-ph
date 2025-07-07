<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataAlat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample monitoring data
        $sampleData = [
            [
                'ph' => '7.2',
                'tds' => '150',
                'turbidity' => '0.8',
                'keterangan' => 'Kondisi air normal'
            ],
            [
                'ph' => '7.1',
                'tds' => '145',
                'turbidity' => '0.9',
                'keterangan' => 'Kondisi air stabil'
            ],
            [
                'ph' => '7.3',
                'tds' => '155',
                'turbidity' => '0.7',
                'keterangan' => 'Kualitas air baik'
            ],
            [
                'ph' => '6.8',
                'tds' => '180',
                'turbidity' => '1.2',
                'keterangan' => 'Perlu monitoring'
            ],
            [
                'ph' => '7.5',
                'tds' => '120',
                'turbidity' => '0.5',
                'keterangan' => 'Kondisi optimal'
            ]
        ];

        foreach ($sampleData as $data) {
            DataAlat::create($data);
        }
    }
}
