<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['title'] = 'Posts Listing';
        $data['posts'] = Post::with(['cat'])->paginate(10);
        return view('posts.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['title'] = 'Add post';

        $data['categories'] = Category::all();

        return view('posts.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'nullable',
            'status' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors())->withInput();

            //$data['errors']  = $validator->errors();
            //return view('categories.create',$data);
        } else {

            $input = $request->all();

            if ($request->hasFile('image')){

                $input['image'] = $request->file('image')->store('uploads','public');
                //$input['image'] = $img_path;
            }


            $res = Post::create($input);

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $title = 'Post Details';

        $result = Post::with(['cat'])->find($id);

        return view('posts.details', compact('title', 'result'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data['title'] = 'Edit post';

        $data['categories'] = Category::all();
        $data['res'] = Post::find($id);

        return view('posts.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'nullable',
            'status' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors())->withInput();

            //$data['errors']  = $validator->errors();
            //return view('categories.create',$data);
        } else {

            $input = $request->all();
            $res = Post::find($id);

            if ($request->hasFile('image')){

                $input['image'] = $request->file('image')->store('uploads','public');

                if (!empty($res->image) && file_exists(storage_path('app/public/'.$res->image))){
                    unlink(storage_path('app/public/'.$res->image));
                }
            }

            $res->update($input);

            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $res = Post::find($id);
        if (!empty($res->image) && file_exists(storage_path('app/public/'.$res->image))){
            unlink(storage_path('app/public/'.$res->image));
        }
        $ress = $res->delete();
        if ($ress) {
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        }else{
            return redirect()->route('posts.index')->with('error', 'Post not deleted successfully.');
        }
    }
}
