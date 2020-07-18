<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index() {

        return  PostResource::collection(request()->user()->posts);
    }

    public function store(Request $request) {

        $data = $request->validate([
            'data.attributes.body' => '',

        ]);

        $post = $request->user()->posts()->create($data['data']['attributes']);

        return new PostResource($post);
    }
}
