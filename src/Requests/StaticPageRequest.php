<?php

namespace App\Requests;

use App\Services\Validation\FormRequests;
use App\Services\Validation\FormErrors;

class StaticPageRequest
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
        if ($this->request) {
            return [
                'slug' => 'required',
                'title'  => 'required|min:3|max:255',
                'description' => 'required',
            ];
        }

        return [
            'slug' => 'required|unique:pages,slug',
            'title'  => 'required|min:3|max:255',
            'description' => 'required',
        ];
    }
}
