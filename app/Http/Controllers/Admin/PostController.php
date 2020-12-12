<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Post;
use App\Jobs\CropThumbnailJob;

use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::paginate(10);
        
        // Demo send logging to slack with level: info, debug, critical
        Log::info('Demo - Someone viewed all posts.');
        Log::debug('Demo - Some errors was happend');
        
        // Custom log level to slack LaravelMonitoring
        Log::channel('slack_info')->info('Demo - Someone viewed all posts.');
        Log::channel('slack_debug')->debug('Debug - Some errors was happend.');
        
        return Inertia::render('Posts/Index', ['data' => $data->items()]);

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
  
        $post = Post::create($request->all());

        // Dispatch for crop multiple size for post thumbnail
        // onQueue: default, foo
        // see queue group in Current Workload line
        CropThumbnailJob::dispatch($post)->onQueue('default');;
  
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
