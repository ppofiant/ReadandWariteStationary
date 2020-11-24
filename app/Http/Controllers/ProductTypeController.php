<?php

namespace App\Http\Controllers;

use App\DetailTransaction;
use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DetailTransaction::select(DB::raw('SUM(qty) as quantity, product_id'))
        ->groupBy('product_id')
        ->orderBy('quantity', 'DESC')->get();

        $productTypes = ["","","",""];
        for ($i = 0; $i < count($products); $i++) {
            $temp = $products[$i]->products->productTypes;
            for ($j = 0; $j < 4; $j++) {
                if($productTypes[$j]==null){
                    $productTypes[$i] = $products[$i]->products->productTypes;
                    break;
                }
                if ($productTypes[$j] == $temp) {
                    break;
                }
            }
            if($productTypes[3]!=null)break;
        }
        // dd($productTypes);
        return view('pages.welcome',["productTypes" => $productTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() == false) return redirect('/home');
        $user = Auth::user();
        if ($user->role == 'member') {
            return redirect('/home');
        }
        $productTypes = ProductType::get();
        return view('stationaryTypes.add', ['productTypes' => $productTypes]);
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
            'name' => 'required|unique:product_types,name',
            'image' => 'required|file|image|mimes:jpeg,png,jpg'
        ]);

        $image = $request->image;
        if ($image) {
            $image->move('asset', $image->getClientOriginalName());
        }

        ProductType::create([
            'name' => $request->name,
            'image' =>  $image->getClientOriginalName()
        ]);

        return redirect('/productType/add');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (Auth::check() == false) return redirect('/home');
        $user = Auth::user();
        if ($user->role == 'member') {
            return redirect('/home');
        }
        $productTypes = ProductType::get();
        return view('stationaryTypes.update', ['productTypes' => $productTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:product_types,name',
        ]);
        $productType = ProductType::find($id);
        $productType->name = $request->name;
        $productType->save();
        return redirect('/productType/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductType::destroy($id);
        return redirect('/productType/edit');
    }
}
