<?php

namespace App;

use function helpers\includeView;

class View implements Renderable
{
    private $path;
    private $file;
    private $data;

    public function __construct($path, $data = [])
    {
        $this->path = str_replace('.', '/', $path);
        $this->file = VIEW_DIR . $this->path . '.php';
        $this->data = $data;
    }

    public function render()
    {
        $data = $this->data;
        includeView($this->file, $this->data);
    }
}
