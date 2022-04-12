<?php

namespace App\Services\Validation;

use Illuminate\Http\UploadedFile as File;

class DataValidation
{
    private $dataToValidate;

    public function formValidation()
    {
        $this->dataToValidate = [];

        foreach ($_POST as $key => $value) {
            $this->dataToValidate[$key] = trim(htmlspecialchars($value));
        }

        foreach ($_FILES as $key => $value) {
            if ($value['tmp_name']) {
                $file = new File($value['tmp_name'], $value['name']);
                $this->dataToValidate[$key] = $file;
            }
        }

        return $this->dataToValidate;
    }
}
