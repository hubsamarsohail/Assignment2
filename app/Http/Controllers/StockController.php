<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\StockRepositoryInterface;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{

    public $stockRepo;
    public $productRepo;
    public function __construct(StockRepositoryInterface $stockRepo, ProductRepositoryInterface $productRepo)
    {
        $this->stockRepo = $stockRepo;
        $this->productRepo = $productRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stocks = $this->stockRepo->allStocks();
        return view('stock.index', compact('stocks'));
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
        $this->validate($request, [
            'name' => 'required|min:4',
            'location' => 'required|min:4'
        ]);

        $stock = $this->stockRepo->addStock($request->only(['name', 'location']));

        $data = $this->productRepo->allProducts()->map(function ($product) use ($stock) {
            return ['stock_id' => $stock->id, 'product_id' => $product->id, 'created_at' => now(), 'updated_at' => now()];
        })->toArray();

        DB::table('product_stock')->insert($data);

        return redirect()->route('stock.index')->with('success', 'Added Stock');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
        return view('stock.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
        return view('stock.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
        $stock->update($request->only(['name', 'location']));
        return redirect()->route('stock.show', ['stock' => $stock->stock_id])->with('success', 'Updated Stock');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
        $stock->delete();
        return redirect()->route('stock.index')->with('success', 'Deleted Stock');
    }
}
