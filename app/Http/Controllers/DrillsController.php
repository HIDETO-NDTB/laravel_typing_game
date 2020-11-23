<?php

namespace App\Http\Controllers;

use App\Category;
use App\Drill;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DrillsController extends Controller
{
    public  function index() {
        $drills = Drill::all();
        return view('drills.index', compact('drills'));
    }

    public function new() {
        $categories = Category::all();
        return view('drills.new')->with('categories', $categories);
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'question0' => 'string|max:255',
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

        return redirect('/')->with('flash_message', __('Registerd'));
    }

    public function edit($id) {
        if (!ctype_digit($id)) {
            return redirect('/')->with('flash_message', __('Invalid operation was performed'));
        }
        $drills = Drill::find($id);
        $categories = Category::all();
        $selected_category = $drills->category_id;
//        Log::debug($drills);
//        Log::debug($categories);
//        Log::debug($selected_category);
        $questions = Question::where('drill_id', $id)->get();
        return view('drills.edit', compact('drills', 'categories', 'selected_category', 'questions'));
    }

    public function update(Request $request, $id) {
        if (!ctype_digit($id)) {
            return redirect('/')->with('flash_message', __('Invalid operation was performed'));
        }
        // 1-1 $idでdrillを取得
        // 1-2 titleとcategory_idのバリデート〜変更
        // 1-3 $idでquestionを取得
        // 1-4 questionのバリデート〜変更、追加分は挿入
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'question1' => 'string|max:255',
        ]);
        $drill = Drill::find($id);
        $drill->title = $request->title;
        $drill->category_id = $request->category_id;
        $drill->save();

        $i = 1;
        $questions = Question::where('drill_id', $id)->get();
        foreach ($questions as $question) {
            $question->question = $request->input('question'.$i);
            $question->save();
            $i++;
        }

        for ($i; $i<=10; $i++) {
            if($request->filled('question'.$i)) {
                $question = new Question;
                $question->question = $request->input('question'.$i);
                $question->drill_id = $drill->id;
                $question->save();
            } else {
                return redirect('/')->with('flash_message', __('Registerd'));
            }
        }

        return redirect('/')->with('flash_message', __('Registerd'));


        // 2-1 drillsテーブルにdelete_flg追加
        // 2-2 index.blade edit.bladeの変更（delete_flgがfalseで表示）
        // 2-3 新たな修正項目のバリデート
        // 2-4 新たにdrillsとquestionsに挿入
        // 2-5 元々のデータのdelete_flgをtrueに変更
    }

    public function destroy($id) {
        if (!ctype_digit($id)) {
            return redirect('/')->with('flash_message', __('Invalid operation was performed'));
        }
        // $idでdrillを取得
        // $idでquestionsを取得
        // 取得したquestionsを全て削除
        // 取得したdrillを削除
        $drill = Drill::find($id);
        $questions = Question::where('drill_id', $id);

        $questions->delete();
        $drill->delete();
        return redirect('/')->with('flash_message', __('Deleted'));

    }
}
