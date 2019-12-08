<?php

use Illuminate\Database\Seeder;
use App\table_rank;


class RanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rank = [
            'Рядовой', 'Младший сержант', 'Сержант', 'Старший сержант', 'Старшина', 'Прапорщик', 'Старший прапорщик',
            'Младший лейтенант', 'Лейтенант', 'Старший лейтенант', 'Капитан', 'Майор', 'Подполковник', 'Полковник', 'Генерал-майор'
        ];
        foreach ($rank as $key => $value) {
            table_rank::create(['rank' => $value]);
        }
    }
}
