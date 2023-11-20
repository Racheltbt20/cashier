<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute minimal :max karakter',
        ];

        $validationData = $request->validate([
            'name' => 'required|min:2|max:20'
        ], $message);

        Category::create($validationData);

        return redirect()->back()->with('success', 'Category berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category = Category::find($category->id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute minimal :max karakter',
        ];

        $validationData = $request->validate([
            'name' => 'required|min:2|max:20'
        ], $message);

        Category::where('id', $category->id)
                ->update($validationData);
        
        return redirect()->back()->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::find($category->id)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
