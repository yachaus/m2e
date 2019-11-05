<?php


namespace app\models;


interface Repository
{
    public function save($file);
    public function get($id, $destination);
}