<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class UserException extends Exception
{
    public function render(Request $request)
    {
        return response()->view('errors.500', [], 500);
    }
}
