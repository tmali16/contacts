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
            'Председатель',
            'Первый заместитель председателя',
            'Заместитель председателя',
            'Советник председателя',
            'Помощник председателя',
            'Начальник',
            'Заместитель начальника',
            'Оперуполномоченный',
            'Старший оперуполномоченный',
            'Инспектор',
            'Старший инспектор',
            'Младший инспектор',
            'Приемная'
        ];

        foreach ($dol as $key => $value) {
            doljnost_list::create(['doljnost' => $value]);
        }
    }
}
