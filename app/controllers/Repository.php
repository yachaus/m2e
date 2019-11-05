<?php

namespace app\controllers;

use app\Config;
use App\Exceptions\E404;

class Repository extends Base
{
    protected $data;
    protected $repository;

    public function __construct($data)
    {
        $this->data = $data;
        if (count($this->data) < 3) {
            throw new E404("Input 3d parameter!");
        }
        $repository = Config::instance();
        $this->repository = $repository->data['repository'][0];
    }

    public function actionSave()
    {
        $file = new $this->repository();
        $file->save($this->data[2]);
        echo "\e[32mFile has been successfully uploaded! File id: " . $file->getId() . "\e[0m\n";
    }

    public function actionGet()
    {
        $destination = isset($this->data[3]) ? $this->data[3] : $_SERVER['PWD'];
        $file = new $this->repository();
        $file->get($this->data[2], $destination);
    }
}