<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user) {

        return PostResource::collection($user->posts);
    }
}
