<?php

namespace Illuminate\Http;

use Symfony\Component\HttpFoundation\File\UploadedFile as File;

class UploadedFile extends File
{
    public function createFormBase(File $file, $test = false)
    {
        return $file instanceof static ? $file : new static(
            $file->getPathname(),
            $file->getClientOriginalName(),
            $file->getClientMimeType(),
            $file->getError(),
            $test
        );
    }
}
