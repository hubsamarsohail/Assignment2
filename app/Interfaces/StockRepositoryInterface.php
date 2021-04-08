<?php

namespace App\Interfaces;

interface StockRepositoryInterface
{
    public function addStock($data);
    public function deleteStock($stock_id);
    public function findByID($stock_id);
    public function restoreStock($stock_id);
    public function updateStock($stock_id, $data);
    public function allStocks();
}
