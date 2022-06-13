<?php

namespace App\Requests;

use App\Services\Validation\FormRequests;
use App\Services\Validation\FormErrors;

class LoginRequest
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
            'email'  => 'required|email',
            'password' => 'required|min:6|max:12',
        ];
    }
}
