<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index() {

        $friends = Friend::friendships();

        if($friends->isEmpty()) {
            return PostResource::collection(request()->user()->posts);

        }

        return PostResource::collection(
            Post::whereIn('user_id',[$friends->pluck('user_id'), $friends->pluck('friend_id')])->get()
        );
    }

    public function store(Request $request) {

        $data = $request->validate([
            'body' => '',

        ]);

        $post = $request->user()->posts()->create($data);

        return new PostResource($post);
    }
}
