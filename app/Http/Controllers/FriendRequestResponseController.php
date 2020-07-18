<?php

namespace App\Http\Controllers;

use App\Exceptions\FriendRequestNotFound;
use App\Friend;
use App\Http\Resources\FriendResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FriendRequestResponseController extends Controller
{
    public function store(Request $request) {

      $data = $request->validate([
                'user_id'=> 'required',
                'status' => 'required'
            ]);

      try{
          $friendRequest = Friend::where('user_id', $request->get('user_id'))
              ->where('friend_id', auth()->user()->id)
              ->firstOrFail();
      }catch (ModelNotFoundException $e) {
            throw new FriendRequestNotFound();
      }


        $friendRequest->update(array_merge($data,[
            'confirmed_at' => now()
        ]));

        return new FriendResource($friendRequest);
    }

    public function destroy() {

        $data = \request()->validate([
            'user_id' => ''
        ]);

        try{
            Friend::where('user_id', $data['user_id'])
                ->where('friend_id', auth()->user()->id)
                ->firstOrFail()
                ->delete();
        }catch (ModelNotFoundException $e){
            throw  new FriendRequestNotFound();
        }


        return response()->json([],204);
    }
}
