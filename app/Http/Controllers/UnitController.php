<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Exporter;
use Importer;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units=Unit::orderBy('id', 'desc')->get();
        return view('unit.index', compact('units'));
    }

    public function import()
    {
        return view('unit.import');
    }

    public function importStore(Request $request)
    {
        $filepath= $request->file('excel');
        $excel = Importer::make('Excel');
        $excel->load($filepath);
        $collections = $excel->getCollection();
        foreach ($collections as $collection){
            Unit::create([
                'id'=>$collection[0],
                'name'=>$collection[1],
                'deleted_at'=>$collection[2],
                'created_at'=>$collection[3],
                'updated_at'=>$collection[4],
            ]);
        }
        return redirect('units')->with('success', 'Units inport success');

    }
    public function export()
    {
        $units=Unit::orderBy('id','desc')->get();
        $excel = Exporter::make('Excel');
        $excel->load($units);
        return $excel->stream('units.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unitValid($request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
    }
    public function store(Request $request)
    {
        $this->unitValid($request);
        $input=$request->all();

        try{
            Unit::create($input);
            return redirect('units')->with('success', 'Unit created');
        }
        catch (\Exception $e){
            return redirect('units')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('unit.edit', compact('unit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        $input=$request->all();

        try{
            $unit->update($input);
            return redirect('units')->with('success', 'Unit update success');
        }
        catch (\Exception $e){
            return redirect('units')->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
