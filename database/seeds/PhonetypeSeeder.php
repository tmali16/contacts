<?php

use Illuminate\Database\Seeder;
use App\PhoneType;

class PhonetypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = ['Городской', 'Внутренний', 'Сотовый'];
        foreach ($type as $key => $value) {
            PhoneType::create(['type' => $value]);
        }
    }
}
