<?php


namespace app;

class Config
{
    use Singleton;

    public $data;

    protected function __construct()
    {
        $this->data = include __DIR__ . '/../config.php';
    }
}