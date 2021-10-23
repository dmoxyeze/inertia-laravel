<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $req)
    {
        $data['posts'] = Post::with('category')->get();
        $data['categories'] = Category::all();
        return Inertia::render('Posts/Index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
            'category' => ['required', 'integer']
        ])->validate();

        Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category_id' => $validated['category'],
            'slug' => Str::slug($validated['title'], '-')
        ]);

        return redirect()->back()
            ->with('message', 'Post Created Successfully.');
    }

    public function update(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
            'category' => ['required', 'integer']
        ])->validate();

        if ($request->has('id')) {
            Post::find($request->input('id'))->update([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'category_id' => $validated['category'],
                'slug' => Str::slug($validated['title'], '-')
            ]);
            return redirect()->back()
                ->with('message', 'Post Updated Successfully.');
        }
    }

    public function delete_post(Request $request)
    {
        //die($request->input('id'));
        if ($request->has('id')) {
            Post::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
