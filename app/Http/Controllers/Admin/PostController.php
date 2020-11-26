<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return Inertia::render('Posts/Index', ['data' => $data]);

        // return Inertia::render('Posts/Index', [
        //     'sessions' => $this->sessions($request)->all(),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required'],
        ])->validate();
  
        Post::create($request->all());
  
        return redirect()->back()
                    ->with('message', 'Post Created Successfully.');
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required'],
        ])->validate();
  
        if ($request->has('id')) {
            Post::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Post Updated Successfully.');
        }
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Post::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }

    public function show(Request $request)
    {
        return Inertia::render('Profile/Show', [
            'sessions' => $this->sessions($request)->all(),
        ]);
    }
}
