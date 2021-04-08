<?php


namespace App\Repository;

use App\Interfaces\ProductRepositoryInterface;
use App\Model\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function addProduct($data)
    {

        return Product::create($data);
    }

    public function findProductByName($product_name){
        return Product::where('name',$product_name)->first();
    }

    public function isUnderVat($product_name)
    {
        return $this->findProductByName($product_name)->under_vat == 'on';
    }

    public function vatPercent($product_name){
        // return $this->findProductByName($product_name)
    }

    public function allProducts()
    {
        return Product::paginate(10);
    }

    public function listProducts()
    {
        return Product::all()->toJson();
    }
    public function deleteProduct($product_id)
    {
    }

    public function findByID($product_id)
    {
        return Product::where('uuid', $product_id)->first();
    }

    public function restoreProduct($product_id)
    {
    }

    public function updateProduct($product_id, $data)
    {
    }

    public function updateQuantity($item, $warehouse_id, $add = true)
    {
        $product = Product::where('name', $item['product_name'])->first();
        if ($add) $newQuantity = (float) $product->quantity + (float) $item['quantity_observed'];
        else $newQuantity = (float) $product->quantity - (float) $item['quantity_observed'];
        $product->update(['quantity' => $newQuantity]);
        //warehouse_id, $product_id;
        // dd('ji');
        $warehouse = DB::table('product_stock')->where('stock_id', $warehouse_id)->where('product_id', $product->id);
        $quantity = $add ? (float) ($warehouse->first()->quantity + $item['quantity_observed']) : (float) ($warehouse->first()->quantity - $item['quantity_observed']);
        $warehouse->update(['quantity' => $quantity]);
        return true;
    }

    public function updateManyQuantity($items, $warehouse_id, $add = true)
    {
        foreach ($items as $item) {
            $this->updateQuantity($item, $warehouse_id, $add);
        }
        return true;
    }
}
