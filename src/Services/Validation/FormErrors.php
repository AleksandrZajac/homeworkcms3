<?php

namespace App\Services\Validation;

trait FormErrors
{
    public function errors()
    {
        $validation = new FormValidation($this->rules());
        return $validation->errors();
    }
}
