<?php

namespace App\Requests;

// use App\Form\FormValidation;
use App\Form\FormRequests;
use App\Form\FormErrors;
// use App\Form\FileValidation;

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
            'title'  => 'required|max:4',
            'image' => 'required|mimes:png',
            'image2' => 'required|image',

            // 'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:48',
            'description' => 'required',
        ];
    }
}
