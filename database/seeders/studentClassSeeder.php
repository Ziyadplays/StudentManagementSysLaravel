<?php

namespace Database\Seeders;

use App\Models\studentClass;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class studentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = ['A' , 'B'];
        for ($i = 1 ; $i <= 10 ; $i++){
            for($j = 0 ; $j <= 1;$j++){
                studentClass::create([
                    'name' => $i,
                    'section' => $section[$j]
                ]);
            }
        }
    }



}
