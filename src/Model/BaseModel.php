<?php

namespace App\Model;

use Doctrine\DBAL\DriverManager;
use Symfony\Component\Yaml\Yaml;

class BaseModel {
/*
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function findAll() {
        return $this->database->fetchAll('SELECT * FROM posts');
    }
    */

    public $conn;
    public $table;
    
    public function __construct()
    {   

        try {
            $this->params = Yaml::parseFile('../config/database.yaml');
        } catch (ParseException $exception) {
            printf('Unable to parse the YAML string: %s', $exception->getMessage());
        }
        // Doit on intégrer ceci à l'autowiring?
        // Vu qu'on utilise soit de l'__invoke soit du static
        $config = new \Doctrine\DBAL\Configuration();
        $this->conn = DriverManager::getConnection($this->params, $config);

        $this->config();
    }

    private function config(){
        $classname = strtolower(get_class($this));
        if ($pos = strrpos($classname, '\\')) 
            $class = substr($classname, $pos + 1);
        else
            $class = $classname;

        $this->table = preg_replace('/model$/', '', $class) . "s";

    }

    public function findAll() {
        
        try {
            $sql = "SELECT * FROM $this->table";
            dump($sql);
            $stmt = $this->conn->fetchAll($sql);
            return $stmt;
        } catch (ParseException $exception) {
            printf('There is a problem with your statment: %s', $exception->getMessage());
        }
    }

}