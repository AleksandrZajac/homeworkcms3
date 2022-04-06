<?php

namespace App\Form;

trait FormRequests
{
    public function request($var = null)
    {
        $requests = [];

        if ($var == null) {
            foreach ($_POST as $key => $value) {
                $requests[$key] = trim(htmlspecialchars($value));
            }

            return $requests;
        }

        $request = trim(htmlspecialchars($_POST[$var]));

        return $request;
    }
}
