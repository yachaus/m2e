<?php


namespace app\models;

use App\Exceptions\E404;

class Directory implements Repository
{
    private $directory = __DIR__ . '/../../repository/';
    private $id;

    public function save($file)
    {
        if (!file_exists($file)) {
            throw new E404('File: ' . $file . ' doesn\'t exist!');
        }
        if (file_exists($this->directory)) {
            $path_parts = pathinfo($file);
            $this->id = uniqid();
            copy($file, $this->directory . $this->id . '.' . $path_parts['extension']);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function get($id, $destination)
    {
        if (!glob("$this->directory$id.*")) {
            throw new E404("ID: $id doesn't correspond to any file!");
        }
        if (!file_exists($destination)) {
            throw new E404("Destination folder doesn't exist!");
        }
        $file_path = glob("$this->directory$id.*");
        $file_path = $file_path[0];
        $path_info = pathinfo($file_path);
        $file = $path_info['basename'];
        $destination = "$destination/$file";
        copy($file_path, $destination);
    }
}