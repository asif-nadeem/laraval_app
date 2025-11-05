<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['title'] = 'Categories List';

        $query = Category::query();

        if ($request->filled('cat_name')) {
//            //$data['categories'] = Category::where('name','=',$request->input('cat_name'))->get();
//            $data['categories'] = Category::where('name','=',$request->input('cat_name'))->get();
//            dd($data['categories']);
            //$query->where('name','=', $request->cat_name);
            $query->where('name', 'LIKE', '%' . $request->cat_name . '%');
            $query->orwhere('description', 'LIKE', '%' . $request->cat_name . '%');
            $data['cat_name'] = $request->cat_name;
        }

        if ($request->filled('desc')) {
            $data['desc'] = $request->desc;
            $query->where('description', 'LIKE', '%' . $request->desc . '%');
        }

        $query->orderBy('id', 'desc');

        $data['categories'] = $query->paginate(4);

        return view('categories.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['title'] = 'Add Category';

        return view('categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['title'] = 'Add Category';

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'required'
        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors())->withInput();

            //$data['errors']  = $validator->errors();
            //return view('categories.create',$data);
        } else {

            $input = $request->all();
            $res = Category::create($input);

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');

        }
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Category Details';

        $result = Category::find($id);

//        $result2 = Category::where('id','=',$id)->get();
//
//        dd($result,$result2);

        return view('categories.details', compact('title', 'result'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Category';
        $res = Category::find($id);
        if (empty($res)) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
        return view('categories.edit', compact('res', 'title'));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'required'
        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors())->withInput();

            //$data['errors']  = $validator->errors();
            //return view('categories.create',$data);
        } else {

            $input = $request->all();
            $res = Category::find($id);

            $res->update($input);

//          $res->name = $input['name'];
//          $res->save();

            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $res = Category::find($id);
        $ress = $res->delete();
        if ($ress) {
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        }else{
            return redirect()->route('categories.index')->with('error', 'Category not deleted successfully.');
        }
        //
    }
}
