<?php

namespace App\Services\FileUpload;

use App\Config;

class File
{
    private $path;
    private $file;
    private $ext;
    public $error;

    public function __construct($fileName)
    {
        if (!$_FILES[$fileName]['error']) {
            $this->path = Config::getInstance()->getConfig('uploads_path');
            $this->file = $_FILES[$fileName];
            $this->ext = $this->pathInfo()['extension'];
        } else {
            return $this->error = 'Upload error';
        }
    }

    public function uploadFile()
    {
        move_uploaded_file($this->file['tmp_name'], $this->path . $this->fileName() . '.' . $this->ext);
    }

    public function addFileName()
    {
        return '/uploads/' . $this->fileName() . '.' . $this->ext;
    }

    public function pathInfo()
    {
        return pathinfo($this->file['name']);
    }

    public function fileName()
    {
        return stristr(str_replace('%', '', rawurlencode($this->file['name'])), '.', true);
    }
}