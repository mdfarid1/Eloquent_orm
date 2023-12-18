<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function deshboard()
    {   $today=Carbon::today();
        $yesterday = Carbon::yesterday();
        $month = Carbon::now();
        $monthStart = $month->startOfMonth();
        $monthEnd = $month->endOfMonth();

        $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();

        $data= array();
        $data['daily_sell_count'] = Sell::whereDate('created_at',$today)->count();
        $data['yesterday_sell_count'] = Sell::whereDate('created_at',$yesterday)->count();
        $data['monthly_sell_count'] = Sell::whereDate('created_at','>=',$monthStart)->whereDate('created_at','<=',$monthEnd)->count();
        $data['prev_month_sell_count'] = Sell::whereDate('created_at','>=',$firstDayofPreviousMonth)->whereDate('created_at','<=',$lastDayofPreviousMonth)->count();
        return view('deshboard',$data);
    }
    public function sale_transaction()
    {
        $products = product::join('sells','products.id','=','sells.product_id')->get();
        return view('sale_transaction', compact('products'));
    }
    public function welcome()
    {
        return view('welcome');
    }
    public function products()
    {
        $products = product::all();
        return view('products', compact('products'));
    }
    public function products_sell()
    {
        $products = product::all();
        return view('products_sell', compact('products'));
    }
    public function update_price()
    {
        $products = product::all();
        return view('update_price', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $rules=$request->validate([
            'name'=>'required|max:225',
            'qnt'=>'required',
            'price'=>'required|numeric'
        ]);

        $product = new product;
        $product->name = $rules['name'];
        $product->price =$rules['price'];
        $product->quantity = $rules['qnt'];
        $product->save();
        return redirect()->route('products')->with('success', 'Product created successfully');

    }
    public function edit($id)
    {
        $product=product::find($id);
        return view('update',compact('product'));
    }
    public function update(Request $request,$id)
    {
        $rules = $request->validate([
            'price'=>'required|numeric'
        ]);

        $product =product::find($id);
        $product->price = $rules['price'];
        $product->save();
        return redirect()->route('products_sell')->with('success', 'Product price update successfully');

    }


    public function sell($id)
    {
        $product = product::find($id);
        return view('sell',compact('product'));
    }

    public function sellUpdate(Request $request,$id)
    {


        $rules = $request->validate([
            'qnt'=>'required',
        ]);
        $product=product::find($id);

        if($request->qnt<=$product->quantity){
            $sells = new Sell;
            $sells->product_id=$id;
            $sells->quantity = $rules['qnt'];
            $sells->save();

            $olddata = $product->quantity;
            $formdata = $rules['qnt'];
            $newQuantity =$olddata-$formdata;
            $product->update(['quantity' => $newQuantity]);

            return redirect()->route('products_sell')->with('success', 'Product sell successfully');
        }else{
            return redirect()->route('products_sell')->with('error', 'Sorry ,this products quantity out of stock');
        }










        // $olddata = $sells->quantity;
        // $formdata = $rules['qnt'];
        // $newQuantity =$olddata-$formdata;
        // $sells->update(['quantity' => $newQuantity]);
        // return redirect()->route('products_sell')->with('success', 'Product sell successfully');

    }


    public function delet($id=null){
        $selldata=Sell::where('product_id',$id)->first();

        DB::beginTransaction();
        try{
            if($selldata){
                $selldata->delete();
            }

            $productdata = product::find($id);
            $productdata->delete();
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        return redirect()->route('products')->with('danger', 'Product Delete successfully');

    }
}
