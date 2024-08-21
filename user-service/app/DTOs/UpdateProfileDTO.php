<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class UpdateProfileDTO
{
    public $name;
    public $email;

    public static function fromRequest(Request $request)
    {
        $data = new UpdateProfileDTO();

        if ($request->has('name')) {
            $data->name = $request->input('name');
        }

        if ($request->has('email')) {
            $data->email = $request->input('email');
        }

        return $data;
    }
}