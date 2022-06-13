<?php

namespace App\Requests;

use App\Services\Validation\FormRequests;
use App\Services\Validation\FormErrors;

class PersonalAreaRequest
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
            'avatar'  => 'image|mimes:jpeg,jpg,png,gif,svg|max:4800',
            'annotation' => 'min:6|max:255',
        ];
    }
}
