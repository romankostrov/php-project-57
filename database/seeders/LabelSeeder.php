<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = \Carbon\Carbon::now();
        $labels = [
            [
                'name' => 'ошибка',
                'description' => 'Какая-то ошибка в коде или проблема с функциональностью',
            ],
            [
                'name' => 'документация',
                'description' => 'Задача которая касается документации',
            ],
            [
                'name' => 'дубликат',
                'description' => 'Повтор другой задачи',
            ],
            [
                'name' => 'доработка',
                'description' => 'Новая фича, которую нужно запилить',
            ],
        ];

        foreach ($labels as $label) {
            // Проверяем, существует ли уже запись с таким именем
            $existingLabel = DB::table('labels')->where('name', $label['name'])->first();

            // Если запись не существует, добавляем ее
            if (!$existingLabel) {
                DB::table('labels')->insert([
                    'name' => $label['name'],
                    'description' => $label['description'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}