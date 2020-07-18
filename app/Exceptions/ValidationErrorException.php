<?php

namespace App\Exceptions;

use Exception;

class ValidationErrorException extends Exception
{



    public function render($request)
    {
        return  response()->json([
            'errors' =>[
                'code' => 422,
                'title' => 'Error Validation',
                'detail' => 'Error ...',
                'meta' => json_decode($this->getMessage())

            ]
        ],422);
    }
}
