<?php

namespace App\Http\Controllers;
use App\Models\Currency;
use Illuminate\Http\Request;

class Currencycontroller extends Controller
{
    public function index(){

        $currencies =   Currency::paginate(15);
        return view('currencies.index' , compact('currencies'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'rate' => 'required',
        ]);
        $requestdata = $request->all();
        Currency::create($requestdata);
        return back();

    }
}
