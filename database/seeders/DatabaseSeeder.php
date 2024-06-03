<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            Userseeder::class,
            ItemSeeder::class,
        ]);

        \App\Models\Customer::factory(1000)->create();
        \App\Models\Purchase::factory(100)->create();
        
        $items = \App\Models\Item::all();
        \App\Models\Purchase::factory(100)->create()
        ->each(function($purchase) use ($items){
            $purchase->items()->attach(
                $items->random(rand(1,3))->pluck('id')->toArray(),
                ['quantity' => rand(1, 5)]
            );
        });
    }
}
