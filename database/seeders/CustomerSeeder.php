<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()
            ->count(25)
            ->hasInvoces(10)
            ->create();

        Customer::factory()
            ->count(100)
            ->hasInvoces(5)
            ->create();
        
        Customer::factory()
            ->count(100)
            ->hasInvoces(3)
            ->create();

        Customer::factory()
            ->count(5)
            ->create();
        
    }
}
