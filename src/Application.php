<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    public $router;

    public function __construct($router)
    {
        $this->router = $router;
        $this->initialize();
    }

    private function initialize()
    {
        $capsule = new Capsule;
        $config = Config::getInstance();
        $capsule->addConnection($config->getConfig('db'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function run()
    {
        try {
            $routerDispatch = $this->router->dispatch();

            if ($routerDispatch instanceof Renderable) {
                echo $routerDispatch->render();
            } else {
                echo $routerDispatch;
            }
        } catch (\Exception $e) {
            $this->renderException($e);
        }
    }

    public function renderException(\Exception $e)
    {
        if ($e instanceof Renderable) {
            $e->render();
        } else {
            $errorCode = $e->getCode();

            if ($errorCode === 0) {
                $errorCode = 500;
            }

            echo 'Возникла ошибка: ' .  $e->getMessage() . ' Код ошибки ' . $errorCode;
        }
    }
}
