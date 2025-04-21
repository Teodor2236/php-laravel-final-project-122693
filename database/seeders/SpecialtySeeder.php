<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run()
    {
        $specialties = [
            [
                'name' => 'Кардиология',
                'description' => 'cardiology'
            ],
            [
                'name' => 'Неврология',
                'description' => 'neurology'
            ],
            [
                'name' => 'Педиатрия',
                'description' => 'pediatrics'
            ],
            [
                'name' => 'Ортопедия',
                'description' => 'orthopedics'
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
} 