<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function addProduct($data);
    public function allProducts();
    public function deleteProduct($product_id);
    public function findByID($product_id);
    public function listProducts();
    public function findProductByName($product_name);
    public function isUnderVat($product_name);
    public function vatPercent($product_name);
    public function restoreProduct($product_id);
    public function updateManyQuantity($items, $warehouse, $add = true);
    public function updateQuantity($item, $warehouse, $add = true);
    public function updateProduct($product_id, $data);
}
