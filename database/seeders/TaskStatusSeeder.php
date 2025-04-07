<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'новый',
            'в работе',
            'на тестировании',
            'завершен',
        ];

        $now = \Carbon\Carbon::now();

        foreach ($statuses as $status) {
            // Проверяем, существует ли уже запись с таким именем
            $existingStatus = DB::table('task_statuses')->where('name', $status)->first();

            // Если записи не существует, добавляем её
            if (!$existingStatus) {
                DB::table('task_statuses')->insert([
                    'name' => $status,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}