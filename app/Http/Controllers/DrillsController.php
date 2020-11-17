<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class DrillsController extends Controller
{
    public function new() {
        $categories = Category::all();
        return view('drills.new')->with('categories', $categories);
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'question' => 'string|max:255',
        ]);
    }
}
