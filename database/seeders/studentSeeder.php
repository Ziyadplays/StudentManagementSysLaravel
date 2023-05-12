<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class studentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1;$i<=10;$i++){
            for($j = 1;$j <=20 ;$j++){
                Student::create([
                    'name' => fake()->name,
                    'student_class_id' => $j,
                ]);
            }
        }
    }
}
