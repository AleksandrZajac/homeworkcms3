<?php

namespace App\Requests;

use App\Services\Validation\FormRequests;
use App\Services\Validation\FormErrors;

class CommentRequest
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
            'description' => 'required|min:6|max:255',
        ];
    }
}
