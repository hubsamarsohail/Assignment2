<?php


namespace App\Repository;

use App\Interfaces\StockRepositoryInterface;
use App\Models\Stock;

class StockRepository implements StockRepositoryInterface
{
    public function addStock($data)
    {
        return Stock::create($data);
    }

    public function allStocks()
    {
        return Stock::paginate(10);
    }

    public function deleteStock($stock_id)
    {
    }

    public function findByID($stock_id)
    {
        return Stock::where('uuid', $stock_id)->first();
    }

    public function restoreStock($stock_id)
    {
    }

    public function updateStock($stock_id, $data)
    {
    }
}
