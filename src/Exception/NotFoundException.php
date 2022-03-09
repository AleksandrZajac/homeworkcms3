<?php

namespace App\Exception;

use App\Renderable;
use App\Exception\HttpException;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        $errorCode = $this->getCode();

        if ($errorCode === 0) {
            $errorCode = 500;
        }

        echo 'Возникла ошибка: ' . $this->getMessage() . ' Код ошибки - ' . $errorCode;
    }
}
