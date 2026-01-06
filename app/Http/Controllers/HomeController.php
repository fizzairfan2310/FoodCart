<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // Latest foods
        $foods = Food::latest()->get();
        
        return view('home', compact('foods', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $foods = Food::where('name', 'LIKE', "%$query%")->get();
        $categories = Category::all();

        return view('home', compact('foods', 'categories'));
    }
}