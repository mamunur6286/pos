<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Item;
use App\Purchase;
use Illuminate\Http\Request;
use PDF;
use Importer;
use Exporter;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases=Purchase::orderBy('id','desc')->get();
        return view('purchase.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPrice(Request $request)
    {
        $item= Item::find($request->id);

        $data= $item->price;

        $data['price']=$data->purchase_prices;
        $data['name']=Item::where('id',$request->id)->first()->name;
        echo $data;
    }
    public function create()
    {
        $products=Item::pluck('name','id');
        $suppliers=Supplier::pluck('name','id');
        $purchase_no=Purchase::orderBy('purchase_no','desc')->first();

        if(empty($purchase_no->purchase_no)){
            $purchase_no='PRS-'.'0001';
        }else{
            $exp= explode('-',$purchase_no->purchase_no);
            $value=$exp[1];
            $new_val=$value+1;
            $purchase_no='PRS-000'.$new_val;
        }
        return view('purchase.create',compact('products','suppliers','purchase_no'));
    }
    public function import()
    {
        return view('purchase.import');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importStore(Request $request)
    {
        $filepath= $request->file('excel');
        $excel = Importer::make('Excel');
        $excel->load($filepath);
        $collections = $excel->getCollection();
        foreach ($collections as $collection){
            Purchase::create([
                'id'=>$collection[0],
                'purchase_no'=>$collection[1],
                'purchase_date'=>$collection[2],
                'supplier_id'=>$collection[3],
                'item_id'=>$collection[4],
                'quantity'=>$collection[5],
                'price'=>$collection[6],
                'discount'=>$collection[7],
                'amount'=>$collection[8],
                'created_at'=>$collection[9],
                'updated_at'=>$collection[10]
            ]);
        }
        return redirect('purchases')->with('success', 'Items import success');

    }
    public function export()
    {
        $items=Purchase::orderBy('id','desc')->get();
        $excel = Exporter::make('Excel');
        $excel->load($items);
        return $excel->stream('purchase.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'supplier_id'=>'required',
            'purchase_no'=>'required',
            'purchase_date'=>'required',
            'item_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'amount'=>'required',
        ]);
        try{

            foreach ($request->quantity as $key=>$value){
                $array=[
                    'purchase_no'=>$request->purchase_no,
                    'purchase_date'=>$request->purchase_date,
                    'supplier_id'=>$request->supplier_id,
                    'item_id'=>$request->item_id[$key],
                    'quantity'=>$request->quantity[$key],
                    'price'=>$request->price[$key],
                    'discount'=>$request->discount[$key],
                    'amount'=>$request->amount[$key],
                ];
                Purchase::insert($array);

            }
            return redirect('purchases')->with('success', 'Purchase Created success');

        }
        catch (\Exception $e){
            return redirect('purchases')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        /*Mail::send('email.show', ['title' => 'fdfdf', 'content' => 'dfdfd'], function ($message)
       {

           $message->from('mamunur200020@gmail.com', 'Christian Nwamba');

           $message->to('mamunur200020@gmail.com');

       });*/

        $purchases= $purchase->where('purchase_no',$purchase->purchase_no)->get();
        return view('purchase.show',compact('purchases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $suppliers=Supplier::pluck('name','id');
        $products=Item::pluck('name','id');

        return view('purchase.edit',compact('products','suppliers','purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request,[
            'supplier_id'=>'required',
            'purchase_date'=>'required',
            'item_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'amount'=>'required',
        ]);
        try{

            foreach ($request->quantity as $key=>$value){
                $array=[
                    'purchase_no'=>$request->purchase_no,
                    'purchase_date'=>$request->purchase_date,
                    'supplier_id'=>$request->supplier_id,
                    'item_id'=>$request->item_id[$key],
                    'quantity'=>$request->quantity[$key],
                    'price'=>$request->price[$key],
                    'discount'=>$request->discount[$key],
                ];
                $purchase->update($array);
                $purchase->amount=$request->amount[$key];
                $purchase->save();

            }
            return redirect('purchases')->with('success', 'Purchase Update success');
        }
        catch (\Exception $e){
            return redirect('purchases')->with('error', 'Something went wrong');
        }
    }
    public function pdfPurchase($id)
    {
        $purchases= Purchase::where('purchase_no',$id)->get();

        $pdf=PDF::loadView('purchase.purchase_print',compact('purchases'));
        return $pdf->stream('invoice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect('purchases')->with('success','Your purchase delete successful.');

    }
}
