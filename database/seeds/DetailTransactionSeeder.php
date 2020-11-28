<?php

use Illuminate\Database\Seeder;
use App\DetailTransaction;

class DetailTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 2; $j++) {
                $detailTransaction = new DetailTransaction;
                $detailTransaction->fill(["transaction_id" => $i + 1, "product_id" => rand(1, 14), "qty" => rand(1, 10)]);
                $detailTransaction->save();
            }
        }
    }
}
