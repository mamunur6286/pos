<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;
use Exporter;
use Importer;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $categories=Category::orderBy('id', 'desc')->get();
        return view('category.index', compact('categories'));
    }
    public function import()
    {
        return view('category.import');
    }

    public function importStore(Request $request)
    {
        $filepath= $request->file('excel');
        $excel = Importer::make('Excel');
        $excel->load($filepath);
        $collections = $excel->getCollection();
        foreach ($collections as $collection){
            Category::create([
                'id'=>$collection[0],
                'name'=>$collection[1],
                'description'=>$collection[2],
                'photo'=>$collection[3],
                'comments'=>$collection[4],
                'deleted_at'=>$collection[5],
                'created_at'=>$collection[6],
                'updated_at'=>$collection[7]
            ]);
        }
        return redirect('categories')->with('success', 'Category inport success');

    }
    public function export()
    {
        $category=Category::orderBy('id','desc')->get();
        $excel = Exporter::make('Excel');
        $excel->load($category);
        return $excel->stream('categories.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'photo' => 'mimes:jpeg,jpg,png,ico,JPG|max:1024',
            'name'=>'required',
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
            Category::create($input);
            return redirect('categories')->with('success', 'Category created');
        }
        catch (\Exception $e){
            return redirect('categories')->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(empty($request->photo)){
            try{
                $input=$request->all();
                $input['photo']=$category->photo;
                $data=$category->update($input);
                return redirect('categories')->with('success', 'Category updated');
            }
            catch (\Exception $e){
                return redirect('categories')->with('error', 'Something went wrong');
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
                unlink('files/'.$category->photo);
                $data=$category->update($input);
                return redirect('categories')->with('success', 'Categories updated');
            }
            catch (\Exception $e){
                return redirect('categories')->with('error', 'Something went wrong');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        unlink('files/'.$category->photo);
        $category->delete();
        return redirect('categories')->with('success','Your category delete successful.');

    }
}
