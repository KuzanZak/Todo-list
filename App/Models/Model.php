<?php

namespace App\Models;

use PDO;
use FFI\Exception;

abstract class Model
{
    protected PDO $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=localhost;dbname=todolist;charset=utf8',
                'todolist',
                'axaLpG9jTP[(pTZE'
            );
            $this->connection->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );
        } catch (Exception $e) {
            die("Unable to connect to the database.
                " . $e->getMessage());
        };
    }
}
