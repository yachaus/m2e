<?php

namespace app\controllers;

class Error extends Base
{
    public $message;

    public function __construct($message = null)
    {
        $this->message = $message;
    }

    public function actionE404()
    {
        echo "\e[41m".$this->message."\e[0m\n";
    }
}