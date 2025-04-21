<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        $doctors = [
            // Кардиолози
            [
                'name' => 'Д-р Иван Иванов',
                'email' => 'ivanov@hospital.com',
                'phone' => '0888123456',
                'specialty_id' => 1,
                'about' => 'Кардиолог с 15 години опит. Специализира в лечението на сърдечно-съдови заболявания.',
                'working_hours' => '09:00-17:00'
            ],
            [
                'name' => 'Д-р Мария Петрова',
                'email' => 'petrova@hospital.com',
                'phone' => '0888123457',
                'specialty_id' => 1,
                'about' => 'Кардиолог с фокус върху превантивната кардиология и ехокардиография.',
                'working_hours' => '09:00-17:00'
            ],
            // Невролози
            [
                'name' => 'Д-р Петър Димитров',
                'email' => 'dimitrov@hospital.com',
                'phone' => '0888123458',
                'specialty_id' => 2,
                'about' => 'Невролог с богат опит в диагностиката и лечението на неврологични заболявания.',
                'working_hours' => '09:00-17:00'
            ],
            [
                'name' => 'Д-р Елена Георгиева',
                'email' => 'georgieva@hospital.com',
                'phone' => '0888123459',
                'specialty_id' => 2,
                'about' => 'Невролог, специализирала в лечението на главоболие и мигрена.',
                'working_hours' => '09:00-17:00'
            ],
            // Педиатри
            [
                'name' => 'Д-р Стефан Николов',
                'email' => 'nikolov@hospital.com',
                'phone' => '0888123460',
                'specialty_id' => 3,
                'about' => 'Педиатър с дългогодишен опит в грижата за деца от всички възрасти.',
                'working_hours' => '09:00-17:00'
            ],
            [
                'name' => 'Д-р Анна Тодорова',
                'email' => 'todorova@hospital.com',
                'phone' => '0888123461',
                'specialty_id' => 3,
                'about' => 'Педиатър със специален интерес към детската пулмология и алергология.',
                'working_hours' => '09:00-17:00'
            ],
            // Ортопеди
            [
                'name' => 'Д-р Георги Стоянов',
                'email' => 'stoyanov@hospital.com',
                'phone' => '0888123462',
                'specialty_id' => 4,
                'about' => 'Ортопед-травматолог с опит в спортната медицина.',
                'working_hours' => '09:00-17:00'
            ],
            [
                'name' => 'Д-р Димитър Ангелов',
                'email' => 'angelov@hospital.com',
                'phone' => '0888123463',
                'specialty_id' => 4,
                'about' => 'Ортопед, специализиран в ендопротезиране и артроскопска хирургия.',
                'working_hours' => '09:00-17:00'
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
} 