<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!'); 
        $this->call('PriceSeeder');
        $this->command->info('Seeded the prices!'); 
        $this->call('SchoolsSeeder');
        $this->command->info('Seeded the schools!'); 
        $this->call('BankSeeder');
        $this->command->info('Seeded the Bank!'); 
    }
}
