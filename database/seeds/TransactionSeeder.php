<?php

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'description' => 'Just another description',
            'ammount' => 300,
            'area_id' => 1,
            'user_id' => 1,
        ]);
    }
}
