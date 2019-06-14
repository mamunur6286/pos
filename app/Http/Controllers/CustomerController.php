<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Validator;
use Exporter;
use Importer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::orderBy('id', 'desc')->get();
        return view('customer.index', compact('customers'));
    }
    public function import()
    {
        return view('customer.import');
    }

    public function importStore(Request $request)
    {
        $filepath= $request->file('excel');
        $excel = Importer::make('Excel');
        $excel->load($filepath);
        $collections = $excel->getCollection();
        foreach ($collections as $collection){
            Customer::create([
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
        return redirect('customers')->with('success', 'Customers inport success');

    }
    public function export()
    {
        $customers=Customer::orderBy('id','desc')->get();
        $excel = Exporter::make('Excel');
        $excel->load($customers);
        return $excel->stream('customers.xlsx');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');

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
            'name'=>'required|min:6',
            'image' => 'mimes:jpeg,jpg,png,ico,JPG|max:2048',
            'mobile'=>'required',
            'email'=>'required',
            'city'=>'required',
            'country'=>'required',
            'address'=>'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input=$request->all();

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
            Customer::create($input);
            return redirect('customers')->with('success', 'Customers created success.');
        }
        catch (\Exception $e){
            return redirect('customers')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Customer $customer)
    {

        $input=$request->all();
        $input['image']=$customer->image;
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
                $customer->update($input);
                return redirect('customers')->with('success', 'Customers update success.');
            }
            catch (\Exception $e){
                return redirect('customers')->with('error', 'Something went wrong');
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
                if($customer->image){
                    unlink($customer->image);
                }
                $customer->update($input);
                return redirect('customers')->with('success', 'Customers update success.');
            }
            catch (\Exception $e){
                return redirect('customers')->with('error', 'Something went wrong');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if(!empty($customer->image)){
            unlink($customer->image);
        }
        $customer->delete();

        return redirect('customers')->with('success','Your customer delete successful.');

    }
}
