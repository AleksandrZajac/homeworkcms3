<?php

namespace App\Requests;

use App\Services\Validation\FormRequests;
use App\Services\Validation\FormErrors;

class SettingsRequest
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
            'items' => 'required|integer|min:1|max:6',
        ];
    }
}
