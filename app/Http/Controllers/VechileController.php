<?php

namespace App\Http\Controllers;

use App\Interfaces\VechileRepositoryInterface;
use App\Models\Vechile;
use Illuminate\Http\Request;

class VechileController extends Controller
{

    public $vechileRepo;
    public function __construct(VechileRepositoryInterface $vechileRepo)
    {
        $this->vechileRepo = $vechileRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vechiles = $this->vechileRepo->allVechiles();
        return view('vechile.index', compact('vechiles'));
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
        // validate the request;
        // dd($request);
        $this->validate($request, [
            'brand' => 'required',
            'capacity' => 'required',
            'plate_number' => 'required',
            'num_compartments' => 'required|min:1'
        ]);

        $this->vechileRepo->addVechile($request->only(['brand', 'capacity', 'plate_number', 'num_compartments']));

        return redirect()->route('vechile.index')->with('success', 'Added Vechile');
        // pass the data to the repository to create the vechile
        // return to the listing page;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vechile  $vechile
     * @return \Illuminate\Http\Response
     */
    public function show(Vechile $vechile)
    {
        //
        return view('vechile.show', compact('vechile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vechile  $vechile
     * @return \Illuminate\Http\Response
     */
    public function edit(Vechile $vechile)
    {
        //
        return view('vechile.edit', compact('vechile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vechile  $vechile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vechile $vechile)
    {
        //

        $vechile->update($request->only(['name', 'brand', 'capacity', 'num_compartments', 'plate_num']));
        return redirect()->route('vechile.show', ['vechile' => $vechile->vechile_id])->with('success', 'Updated Vechile Details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vechile  $vechile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vechile $vechile)
    {
        //
        $vechile->delete();
        return redirect()->route('vechile.index')->with('success', 'Deleted Vechile');
    }
}
