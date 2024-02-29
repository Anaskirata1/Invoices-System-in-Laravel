<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{


    function __construct()
{

$this->middleware('permission: المنتجات ', ['only' => ['products']]);
$this->middleware('permission:اضافة منتج', ['only' => ['create','store']]);
$this->middleware('permission:تعديل منتج', ['only' => ['edit','update']]);
$this->middleware('permission:حذف منتج', ['only' => ['destroy']]);

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::all();
        $sections = sections::all();
        return view('products.products', compact('sections','products')) ;
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
    //     $validated = $request->validate([
    //         'Product_name' => 'required|unique:products|max:255',
    //         'description' => 'required',
    //         'section_id' => 'required',
    //     ],[
    //         'products_name.required' => 'يرجى ادحال اسم البطاقة',
    //         'description.required' => 'يرجى ادحال  الوصف',
    //         'section_id.required' => 'يرجى ادحال  القسم',
    //     ]);

            Products::create([
                'products_name' => $request->Product_name,
                'section_id' => $request->section_id,
                'description' => $request->description,
            ]);
            session()->flash('Add', 'تم اضافة المنتج بنجاح ');
            return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = sections::where('section_name', $request->section_name)->first()->id;

       $Products = Products::findOrFail($request->pro_id);

       $Products->update([
       'Products_name' => $request->Product_name,
       'description' => $request->description,
       'section_id' => $id,
       ]);

       session()->flash('Edit', 'تم تعديل المنتج بنجاح');
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Products = Products::findOrFail($request->pro_id);
         $Products->delete();
         session()->flash('delete', 'تم حذف المنتج بنجاح');
         return back();
    }
}
