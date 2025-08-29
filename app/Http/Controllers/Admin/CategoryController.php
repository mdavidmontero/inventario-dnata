<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:1000',
        ]);

        $category = Category::create($data);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria creada exitosamente',
            'text' => 'La categoria ha sido creada exitosamente',
        ]);
        return redirect()->route('admin.categories.edit', $category)->with('success', 'Categoria creada exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update($data);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria actualizada exitosamente',
            'text' => 'La categoria ha sido actualizada exitosamente',
        ]);
        return redirect()->route('admin.categories.edit', $category)->with('success', 'Categoria actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'La categoria no puede eliminarse porque tiene productos asociados',
            ]);
            return redirect()->route('admin.categories.index');
        }
        $category->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoria eliminada exitosamente',
            'text' => 'La categoria ha sido eliminada exitosamente',
        ]);
        return redirect()->route('admin.categories.index');
    }
}
