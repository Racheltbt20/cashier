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
            'max' => ':attribute maksimal :max karakter',
            'regex' => ':attribute harus huruf',
            'unique' => 'nama telah digunakan'
        ];

        $validationData = $request->validate([
            'name' => 'required|min:2|max:20|regex:/^[a-zA-Z0-9 ]+$/|unique:categories'
        ], $message);

        Category::create($validationData);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
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
            'regex' => ':attribute harus huruf',
            'unique' => 'nama telah digunakan'
        ];

        $validationData = Validator::make($request->all(), [
            'name' => 'required|min:2|max:20|regex:/^[a-zA-Z0-9 ]+$/'
        ], $message);

        if($validationData->fails()) {
            return back()->withErrors($validationData)->withInput()->with('error_update', [
                'a' => $category->id
            ]);
        }

        $category->name = $request->name;
        $category->save();

        // Category::where('id', $category->id)
        //         ->update($validationData);
        
        return redirect()->back()->with('success', 'Kategori berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::find($category->id)->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
