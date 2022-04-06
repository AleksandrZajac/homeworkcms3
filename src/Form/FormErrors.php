<?php

namespace App\Form;

trait FormErrors
{
    public function errors()
    {
        $validation = new FormValidation($this->rules());
        return $validation->errors();
    }
}
