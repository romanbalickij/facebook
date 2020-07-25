<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\ValidationErrorException;
use App\Friend;
use App\Http\Resources\FriendResource;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FriendRequestController extends Controller
{

    public function store(Request $request) {

        $data = $request->validate([
            'friend_id' => 'required'
        ]);


        try{
            User::findorFail($data['friend_id'])
                ->friends()->syncWithoutDetaching(auth()->user()->id);
        }catch (ModelNotFoundException $e) {
            throw new UserNotFoundException();
        }

        return new FriendResource(
          Friend::where('user_id', auth()->user()->id)
          ->where('friend_id', $data['friend_id'])
            ->first()
        );

    }
}
