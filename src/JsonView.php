<?php

namespace App;

class JsonView implements Renderable
{
    private $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        echo json_encode($this->data);
    }
}
