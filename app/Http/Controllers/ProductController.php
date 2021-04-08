<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\StockRepositoryInterface;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public $productRepo;
    public $stockRepo;

    public function __construct(ProductRepositoryInterface $productRepo, StockRepositoryInterface $stockRepo)
    {

        $this->productRepo = $productRepo;
        $this->stockRepo = $stockRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = $this->productRepo->allProducts();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $this->validate($request, [
        //     'brand' => 'required',
        //     'capacity' => 'required',
        //     'plate_number' => 'required',
        //     'num_compartments' => 'required|min:1'
        // ]);

        $product = $this->productRepo->addProduct($request->only(['name', 'under_vat']));

        $data = $this->stockRepo->allStocks()->map(function ($stock) use ($product) {
            return ['stock_id' => $stock->id, 'product_id' => $product->id, 'created_at' => now(), 'updated_at' => now()];
        })->toArray();


        DB::table('product_stock')->insert($data);
        return redirect()->route('product.index')->with('success', 'Added Product');
    }

    public function productList(Request $request)
    {
        return $this->productRepo->listProducts();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        if (!$request->has('under_vat') || $request->under_vat == 'null') {
            $request->request->set('under_vat', 'off');
        }
        $product->update($request->only(['name', 'under_vat']));
        return redirect()->route('product.show', ['product' => $product->product_id])->with('success', 'Updated Product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Deleted product successfully');
    }
}
