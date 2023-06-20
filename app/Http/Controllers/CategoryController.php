<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.category', [
            'title' => 'Category',
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create', [
            'title' => 'Create Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['slug'] = Str::of($request->name)->slug('-');
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'image' => 'required',
        ]);
        $validateData['image'] = $request->file('image')->store('image_post');
        $store = Category::create($validateData);
        return $store ? redirect()->route('category.index')->with('success', 'New post has been added!') : redirect()->route('category.index')->with('failed', 'New post failed to add!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show', [
            'title' => $category->name,
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', [
            'title' => 'Edit Category ' . $category->name,
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validate = [
            'name' => 'sometimes|required',
            'image' => 'sometimes|required',
        ];
        $slug = Str::of($request->name)->slug('-');
        if ($slug != $category->slug) {
            $validate += ['slug' => 'sometimes|required|unique:categories'];
            $request['slug'] = Str::of($request->name)->slug('-');
        }
        $validateData = $request->validate($validate);
        if ($request->image) {
            $validateData['image'] = $request->file('image')->store('image_post');
        }
        $update = $category->update($validateData);
        return  $update ? redirect()->route('category.index')->with('success', 'New post has been added!') : redirect()->route('category.index')->with('failed', 'New post failed to add!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
