<?php

namespace App\Requests;

use App\Services\Validation\FormRequests;
use App\Services\Validation\FormErrors;

class ArticleRequest
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
                'title'  => 'required|min:3',
                'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:4800',
                'description' => 'required',
            ];
        }

        return [
            'slug' => 'required|unique:articles,slug',
            'title'  => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:4800',
            'description' => 'required',
        ];
    }
}
