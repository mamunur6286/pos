<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Exporter;
use Importer;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers=Supplier::orderBy('id', 'desc')->get();
        return view('supplier.index', compact('suppliers'));
    }

    public function import()
    {
        return view('supplier.import');
    }

    public function importStore(Request $request)
    {
        $filepath= $request->file('excel');
        $excel = Importer::make('Excel');
        $excel->load($filepath);
        $collections = $excel->getCollection();
        foreach ($collections as $collection){
            Supplier::create([
                'id'=>$collection[0],
                'name'=>$collection[1],
                'image'=>$collection[2],
                'mobile'=>$collection[3],
                'email'=>$collection[4],
                'address'=>$collection[5],
                'city'=>$collection[6],
                'country'=>$collection[7],
                'status'=>$collection[8],
                'created_at'=>$collection[9],
                'updated_at'=>$collection[10],
            ]);
        }
        return redirect('suppliers')->with('success', 'Suppliers inport success');

    }
    public function export()
    {
        $suppliers=Supplier::orderBy('id','desc')->get();
        $excel = Exporter::make('Excel');
        $excel->load($suppliers);
        return $excel->stream('suppliers.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');

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
            'name'=>'required|min:6',
            'image' => 'mimes:jpeg,jpg,png,ico,JPG|max:2048',
            'mobile'=>'required',
            'email'=>'required',
            'city'=>'required',
            'country'=>'required',
            'address'=>'required',
        ]);



        $input=$request->all();

        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $fileType=$file->getClientOriginalExtension();
            $fileName=$request->name.'_'.rand(1,1000).date('dmyhis').".".$fileType;
            /*$fileName=$file->getClientOriginalName();*/
            $file->move('supplier',$fileName);
            $input['image']='supplier/'.$fileName;
            $input['status']='1';
        }

        try{
            Supplier::create($input);
            return redirect('suppliers')->with('success', 'Suppliers created success.');
        }
        catch (\Exception $e){
            return redirect('suppliers')->with('error', 'Something went wrong');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $input=$request->all();
        $input['image']=$supplier->image;
        $input['status']='1';
        if(empty($request->image)){

            $this->validate($request,[
                'name'=>'required|min:6',
                'mobile'=>'required',
                'email'=>'required',
                'city'=>'required',
                'country'=>'required',
                'address'=>'required',
            ]);


            try{
                $supplier->update($input);
                return redirect('suppliers')->with('success', 'Supplier update success.');
            }
            catch (\Exception $e){
                return redirect('suppliers')->with('error', 'Something went wrong');
            }
        }else{
            $this->validate($request,[
                'name'=>'required|min:6',
                'image' => 'mimes:jpeg,jpg,png,ico,JPG|max:2048',
                'mobile'=>'required',
                'email'=>'required',
                'city'=>'required',
                'country'=>'required',
                'address'=>'required',
            ]);
            if ($request->hasFile('image')) {
                $file=$request->file('image');
                $fileType=$file->getClientOriginalExtension();
                $fileName=$request->name.'_'.rand(1,1000).date('dmyhis').".".$fileType;
                /*$fileName=$file->getClientOriginalName();*/
                $file->move('user',$fileName);
                $input['image']='user/'.$fileName;
                $input['status']='1';
            }

            try{
                if($supplier->image){
                    unlink($supplier->image);
                }
                $supplier->update($input);
                return redirect('suppliers')->with('success', 'Supplier update success.');
            }
            catch (\Exception $e){
                return redirect('suppliers')->with('error', 'Supplier went wrong');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if(!empty($supplier->image)){
            unlink($supplier->image);
        }
        $supplier->delete();

        return redirect('suppliers')->with('success','Your supplier delete successful.');

    }
}
