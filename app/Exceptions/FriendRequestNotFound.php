<?php

namespace App\Exceptions;

use Exception;

class FriendRequestNotFound extends Exception
{


    public function render($request)
    {
        return  response()->json([
            'errors' => [
                'code' => 404,
                'title' =>'Friend Not Found',
                'detail' => 'Unable to locate friend ....'
            ]
        ],404);
    }
}
