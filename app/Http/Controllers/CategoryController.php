<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $req) {
        $data['categories'] = Category::all();
        return Inertia::render('Category/index', ['data' =>$data]); 
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => ['required'],
        ])->validate();
  
        Category::create([
            'name' => $validated['title'],
            'slug' => Str::slug($validated['title'], '-'),
        ]);
  
        return redirect()->back()
                    ->with('message', 'Post Created Successfully.');
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
        ])->validate();
  
        if ($request->has('id')) {
            Category::find($request->input('id'))->update([
                'name' => $request->title,
                'slug' => Str::slug($request->title, '-'),
            ]);
            return redirect()->back()
                    ->with('message', 'Category Updated Successfully.');
        }
    }

    public function delete_category(Request $request)
    {
        if ($request->has('id')) {
            Category::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
