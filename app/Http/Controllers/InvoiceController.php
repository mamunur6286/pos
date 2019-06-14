<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use App\Item;
use App\Price;
use Illuminate\Http\Request;
use Mockery\Exception;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Mail;
use PDF;
use Importer;
use Exporter;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=Invoice::orderBy('id','desc')->get();
        return view('invoice.index',compact('invoices'));
    }

    public function getPrice(Request $request)
    {
        $item= Item::find($request->id);

        $data= $item->price;

         $data['price']=$data->sale_prices;
         $data['name']=Item::where('id',$request->id)->first()->name;
         echo $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $products=Item::pluck('name','id');
        $customers=Customer::pluck('name','id');
        $invoice_no=Invoice::orderBy('invoice_no','desc')->first();

        if(empty($invoice_no->invoice_no)){
            $invoice_no='INV-'.'0001';
        }else{
            $exp= explode('-',$invoice_no->invoice_no);
            $value=$exp[1];
            $new_val=$value+1;
            $invoice_no='INV-000'.$new_val;
        }
        return view('invoice.create',compact('products','customers','invoice_no'));
    }
    public function import()
    {
        return view('invoice.import');
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
            Invoice::create([
                'id'=>$collection[0],
                'invoice_no'=>$collection[1],
                'invoice_date'=>$collection[2],
                'customer_id'=>$collection[3],
                'item_id'=>$collection[4],
                'quantity'=>$collection[5],
                'price'=>$collection[6],
                'discount'=>$collection[7],
                'amount'=>$collection[8],
                'created_at'=>$collection[9],
                'updated_at'=>$collection[10]
            ]);
        }
        return redirect('invoices')->with('success', 'Items import success');

    }
    public function export()
    {
        $items=Invoice::orderBy('id','desc')->get();
        $excel = Exporter::make('Excel');
        $excel->load($items);
        return $excel->stream('invoice.xlsx');
    }


    public function store(Request $request)
    {


        $this->validate($request,[
            'customer_id'=>'required',
            'invoice_no'=>'required',
            'invoice_date'=>'required',
            'item_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'amount'=>'required',
        ]);
        try{

            foreach ($request->quantity as $key=>$value){
                 $array=[
                    'invoice_no'=>$request->invoice_no,
                    'invoice_date'=>$request->invoice_date,
                    'customer_id'=>$request->customer_id,
                    'item_id'=>$request->item_id[$key],
                    'quantity'=>$request->quantity[$key],
                    'price'=>$request->price[$key],
                    'discount'=>$request->discount[$key],
                    'amount'=>$request->amount[$key],
                ];
                 Invoice::insert($array);

            }
            return redirect('invoices')->with('success', 'Invoice Created success');

        }
        catch (\Exception $e){
            return redirect('invoices')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        Mail::send('email.show', ['title' => 'Hello', 'content' => 'From POS'], function ($message)
        {

            $message->from('mamunur200020@gmail.com', 'Md Mamun');

            $message->to('info@mamunur.xyz');

        });

        $invoices= $invoice->where('invoice_no',$invoice->invoice_no)->get();
        return view('invoice.show',compact('invoices'));
    }

    public function pdfInvoice($id)
    {
        $invoices= Invoice::where('invoice_no',$id)->get();

        $pdf=PDF::loadView('invoice.invoice_print',compact('invoices'));
        return $pdf->stream('invoice');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $customers=Customer::pluck('name','id');
        $products=Item::pluck('name','id');

        return view('invoice.edit',compact('products','customers','invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $this->validate($request,[
            'customer_id'=>'required',
            'invoice_no'=>'required',
            'invoice_date'=>'required',
            'item_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'amount'=>'required',
        ]);
        try{

            foreach ($request->quantity as $key=>$value){
                $array=[
                    'invoice_no'=>$request->invoice_no,
                    'invoice_date'=>$request->invoice_date,
                    'customer_id'=>$request->customer_id,
                    'item_id'=>$request->item_id[$key],
                    'quantity'=>$request->quantity[$key],
                    'price'=>$request->price[$key],
                    'discount'=>$request->discount[$key],
                ];
                 $invoice->update($array);
                 $invoice->amount=$request->amount[$key];
                 $invoice->save();

            }
            return redirect('invoices')->with('success', 'Invoice Update success');
        }
        catch (\Exception $e){
            return redirect('invoices')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect('invoices')->with('success','Your invoices delete successful.');

    }
}
