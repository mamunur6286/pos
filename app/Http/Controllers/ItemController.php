<?php

namespace App\Http\Controllers;

use App\Category;
use App\Invoice;
use App\Item;
use App\Price;
use App\Purchase;
use App\Unit;
use Illuminate\Http\Request;
use Validator;
use Exporter;
use Importer;
use DNS2D;
use DNS1D;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        /*$items=Item::orderBy('id','desc')->get();
        $excel = Exporter::make('Excel');
        $excel->load($items);
        return $excel->stream('users.csv');*/

        $items=Item::orderBy('id','desc')->get();
        return view('item.index', compact('items'));
    }
    public function import()
    {
        return view('item.import');
    }

    public function importStore(Request $request)
    {
        $filepath= $request->file('excel');
        $excel = Importer::make('Excel');
        $excel->load($filepath);
        $collections = $excel->getCollection();
        foreach ($collections as $collection){
            Item::create([
                'id'=>$collection[0],
                'category_id'=>$collection[1],
                'name'=>$collection[2],
                'description'=>$collection[3],
                'units'=>$collection[4],
                'photo'=>$collection[5],
                'comments'=>$collection[6],
                'created_at'=>$collection[7],
                'updated_at'=>$collection[8]
            ]);
        }
        return redirect('items')->with('success', 'Items import success');

    }
    public function export()
    {
        $items=Item::orderBy('id','desc')->get();
        $excel = Exporter::make('Excel');
        $excel->load($items);
        return $excel->stream('items.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::pluck('name', 'id');
        $units=Unit::pluck('name', 'id');
        return view('item.create', compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required:min:6',
            'photo' => 'mimes:jpeg,jpg,png,ico,JPG|max:1024',
            'name'=>'required:min:6',

        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input=$request->all();
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $fileType=$file->getClientOriginalExtension();
            $fileName="i_".rand(1,1000).date('dmyhis').".".$fileType;
            /*$fileName=$file->getClientOriginalName();*/
            $file->move('files',$fileName);
            $input['photo']=$fileName;
        }

        try{
            $id=Item::create($input)->id;

            Price::insert([
                'item_id'=>$id,
                'sale_prices'=>'0',
                'purchase_prices'=>'0',
            ]);
            return redirect('items')->with('success', 'Item created');
        }
        catch (\Exception $e){
            return redirect('items')->with('error', 'Something went wrong');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $barcode='<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($item->id, "C39+",3,33,array(1,1,1), true) . '" alt="barcode"   />';
        $item['barcode']=$barcode;
        return view('item.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories=Category::pluck('name', 'id');
        $units=Unit::pluck('name', 'id');
        $price=$item->price;
        $sales=Invoice::orderBy('id','desc')->where('item_id',$item->id)->get();
        $purchases=Purchase::orderBy('id','desc')->where('item_id',$item->id)->get();

        return view('item.edit', compact('item','categories','units','price','sales','purchases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        if(empty($request->photo)){
            try{
                $input=$request->all();
                $input['photo']=$item->photo;
                $data=$item->update($input);
                return redirect('items')->with('success', 'Items updated');
            }
            catch (\Exception $e){
                return redirect('items')->with('error', 'Something went wrong');
            }
        }else{
            $validator = Validator::make($request->all(), [
                'photo' => 'mimes:jpeg,jpg,png,ico,JPG|max:1024',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $input=$request->all();
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $fileType=$file->getClientOriginalExtension();
                $fileName="i_".rand(1,1000).date('dmyhis').".".$fileType;
                /*$fileName=$file->getClientOriginalName();*/
                $file->move('files',$fileName);
                $input['photo']=$fileName;
            }

            try{
                if($item->photo){
                    unlink('files/'.$item->photo);
                }
                $item->update($input);
                return redirect('items')->with('success', 'Items updated');
            }
            catch (\Exception $e){
                return redirect('items')->with('error', 'Something went wrong');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        unlink('files/'.$item->photo);
        $item->delete();
        return redirect('items')->with('success','Your photo delete successful.');

    }
}
