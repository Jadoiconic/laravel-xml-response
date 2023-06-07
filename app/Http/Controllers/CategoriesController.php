<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $response = new Response($categories, 200, [
            'Content-Type' => 'application/xml',
        ]);

        return $response;
    }

    public function show($id)
    {
        $category = Categories::findOrFail($id);

        $response = new Response($category, 200, [
            'Content-Type' => 'application/xml',
        ]);

        return $response;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Categories::create([
            'name' => $validatedData['name'],
        ]);

        if ($validatedData['parent_id']) {
            $parent = Categories::findOrFail($validatedData['parent_id']);
            $category->appendToNode($parent)->save();
        }

        $response = new Response($category, 200, [
            'Content-Type' => 'application/xml',
        ]);

        return $response;
    }

    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        $category->update([
            'name' => $validatedData['name'],
        ]);

        $response = new Response(['message' => 'Category updated successfully'], 200, [
            'Content-Type' => 'application/xml',
        ]);
        return $response;
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        $response = new Response(['message' => 'Category deleted successfully'], 200, [
            'Content-Type' => 'application/xml',
        ]);

        return $response;
    }
}
