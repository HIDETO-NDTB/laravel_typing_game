<?php

namespace App\Http\Controllers;

use App\Category;
use App\Drill;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'question' => 'string|nullable|max:255',
        ]);

        $drill = new Drill;
        $drill->title = $request->title;
        $drill->user_id = Auth::user()->id;
        $drill->category_id = $request->category_id;
        $drill->save();

        $question = new Question;
        $question->question = $request->question0;
        $question->drill_id = $drill->id;
        $question->save();

        for ($i=1; $i<=9; $i++) {
            if($request->filled('question'.$i)) {
                $question = new Question;
                $question->question = $request->input('question'.$i);
                $question->drill_id = $drill->id;
                $question->save();
            } else {
                return redirect('drills/new')->with('flash_message', __('Registerd'));
            }
        }

        return redirect('drills/new')->with('flash_message', __('Registerd'));
    }
}
