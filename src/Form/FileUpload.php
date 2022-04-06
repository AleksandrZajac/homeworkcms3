<?php

namespace App\Form;

class FileUpload
{
    private $originalName;
    private $mimeType;
    private $error;
    private $pathName;
    private $fileName;

    public function __construct($originalName, $mimeType, $error, $pathName, $fileName)
    {
        $this->originalName($originalName);
        $this->mimeType($mimeType);
        $this->error($error);
        $this->pathName($pathName);
        $this->fileName($fileName);
    }

    public function originalName($originalName)
    {
        $this->originalName = $originalName;

        return $this->originalName;
    }

    public function mimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this->mimeType;
    }

    public function error($error)
    {
        $this->error = $error;

        return $this->error;
    }

    public function pathName($pathName)
    {
        $this->pathName = $pathName;

        return $this->pathName;
    }

    public function fileName($fileName)
    {
        $this->fileName = $fileName;

        return $this->fileName;
    }
}
