<?php

namespace App\Requests;

use App\Services\Validation\FormRequests;
use App\Services\Validation\FormErrors;

class ArticleRequest
{
    use FormRequests, FormErrors;

    protected $errors;

    public function __construct()
    {
        $this->errors = $this->errors();
    }

    public function rules()
    {
        return [
            'slug' => 'required|unique:articles,slug',
            'title'  => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:4800',
            'description' => 'required',
        ];
    }
}
