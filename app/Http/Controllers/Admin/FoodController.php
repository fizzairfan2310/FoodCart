<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::with('category')->get();
        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.foods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads'), $imageName);
            $data['image'] = $imageName;
        }

        Food::create($data);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food Added Successfully');
    }

    public function edit(Food $food)
    {
        $categories = Category::all();
        return view('admin.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($food->image && file_exists(public_path('uploads/' . $food->image))) {
                unlink(public_path('uploads/' . $food->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads'), $imageName);
            $data['image'] = $imageName;
        }

        $food->update($data);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food Updated Successfully');
    }

    public function destroy(Food $food)
    {
        // Delete image file
        if ($food->image && file_exists(public_path('uploads/' . $food->image))) {
            unlink(public_path('uploads/' . $food->image));
        }

        $food->delete();
        
        return redirect()->route('admin.foods.index')
            ->with('success', 'Food Deleted Successfully');
    }
}