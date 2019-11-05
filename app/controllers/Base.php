<?php

namespace app\controllers;

use App\Exceptions\E404;

class Base
{
    public static function defineRoute($argv)
    {
        if (isset($argv[1])) {
            $argv = $argv[1];
            switch ($argv) {
                case ($argv == 'save'):
                    $action = 'Save';
                    $controller = 'app\controllers\Repository';
                    break;
                case ($argv == 'get'):
                    $action = 'Get';
                    $controller = 'app\controllers\Repository';
                    break;
                default:
                    throw new E404('Can\'t resolve method: ' . $argv . '!');

            }
        } else
            throw new E404('Input method name!');

            return
                [
                    'action' => $action,
                    'controller' => $controller
                ];
    }

    public function beforeAction()
    {

    }

    public function action($method)
    {
        $this->beforeAction();
        $methodName = 'action' . $method;
        $this->$methodName();
    }
}