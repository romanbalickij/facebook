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
            'image' => '',
            'width' => '',
            'height' => ''

        ]);

        if(isset($data['image'])) {
            $image = $data['image']->store('post-images','public');

        }

        $post = $request->user()->posts()->create([
            'body'  => $data['body'],
            'image' => $image ?? null,

        ]);

        return new PostResource($post);
    }
}
