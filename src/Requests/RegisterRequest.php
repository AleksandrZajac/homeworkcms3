<?php

namespace App\Requests;

use App\Services\Validation\FormRequests;
use App\Services\Validation\FormErrors;

class RegisterRequest
{
    use FormRequests, FormErrors;

    protected $errors;
    protected $request;

    public function __construct($request = null)
    {
        $this->errors = $this->errors();
        $this->request = $request;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email'  => 'required|unique:users,email|email',
            'password' => 'required|min:6|max:12',
            'password2' => 'required|min:6|max:12',
        ];
    }
}
