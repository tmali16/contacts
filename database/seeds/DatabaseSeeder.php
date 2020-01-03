<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(GupravlenieSeeder::class);
        $this->call(RanksSeeder::class);
        $this->call(DoljnostSeeder::class);
        $this->call(PhonetypeSeeder::class);
        
    }
}
