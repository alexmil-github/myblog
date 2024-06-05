<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\AllPostsResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $posts = [];
//
//        foreach (Post::all() as $post) {
//            $posts[] = [
//                'name' => $post->name,
//                'text' => $post->text,
//                'author' => User::find($post->user_id)->first_name . " " . User::find($post->user_id)->last_name,
//            ];
//        }

        return AllPostsResource::collection(Post::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {

       $data = $request->all();
       $data['user_id'] = Auth::id();

       if ($request->image) {
           $data['image'] = $request->image->store('/image', 'public');
       }

       Post::create($data);

       return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        return response()->json($post);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
