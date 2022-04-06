<?php

namespace Illuminate\Http;

use Symfony\Component\HttpFoundation\File\UploadedFile as File;
use App\Exception\FileNotFoundException;

class UploadedFile extends File
{
    // private $originalName;
    // // private $mimeType;
    private $error;
    // // private $pathName;
    // // private $fileName;

    // public function __construct($originalName)
    // // public function __construct($originalName, $mimeType, $error, $pathName, $fileName)
    // {
    //     $this->originalName($originalName);
    //     // $this->mimeType($mimeType);
    //     // $this->error($error);
    //     // $this->pathName($pathName);
    //     // $this->fileName($fileName);
    // }

    // public function originalName($originalName)
    // {
    //     $this->originalName = $originalName;

    //     return $this->originalName;
    // }

    // public function mimeType($mimeType)
    // {
    //     $this->mimeType = $mimeType;

    //     return $this->mimeType;
    // }

    // public function error($error)
    // {
    //     $this->error = $error;

    //     return $this->error;
    // }

    // public function pathName($pathName)
    // {
    //     $this->pathName = $pathName;

    //     return $this->pathName;
    // }

    // public function fileName($fileName)
    // {
    //     $this->fileName = $fileName;

    //     return $this->fileName;
    // }

    // public function get()
    // {
    //     if (!$this->isValid()) {
    //         throw new FileNotFoundException("File does not exist at path {$this->getPathname()}.");
    //     }

    //     return file_get_contents($this->getPathname());
    // }

    // public function isValid()
    // {
    //     $isOk = \UPLOAD_ERR_OK === $this->error;

    //     return $this->test ? $isOk : $isOk && is_uploaded_file($this->getPathname());
    // }
}
