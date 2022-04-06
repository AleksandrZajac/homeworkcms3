<?php

namespace App\Form;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile as File;

class FileValidation
{
    private $dataToValidate;

    // public function __construct()
    // {
    //     $this->fileValidation();
    // }

    public function fileValidation()
    {
        $this->dataToValidate = [];

        foreach ($_POST as $key => $value) {
            $this->dataToValidate[$key] = trim(htmlspecialchars($value));
        }

        foreach ($_FILES as $key => $value) {
            if ($value['tmp_name']) {
                $str = $_FILES[$key]['tmp_name'];
                $arr = explode(DIRECTORY_SEPARATOR, $str);
                $fileName = end($arr);
                // $var = new UploadedFile($value['name']);
                $var = new UploadedFile($value['name'], $value['type'], $value['error'], $value['tmp_name'], $fileName);
                // $file = new File($value['name']);
                // $this->dataToValidate[$key] = $var->originalName($file);
                $this->dataToValidate[$key] = $var;
            }
        }

        return $this->dataToValidate;
    }
}
