<?php

use Illuminate\Database\Seeder;
use App\doljnost_list;


class DoljnostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dol = [
            'Младший инспектор',
            'Инспектор',
            'Старший инспектор',
            'Оперуполномоченный',
            'Старший оперуполномоченный',
            'Заместитель начальника',
            'Начальник',
            'Председатель',
            'Заместитель председателя',
            'Первый заместитель председателя',
            'Помощник председателя',
            'Советник председателя',
        ];
        foreach ($dol as $key => $value) {
            doljnost_list::create(['doljnost' => $value]);
        }
    }
}
