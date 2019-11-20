<?php

namespace application\libraries;

use mysql_xdevapi\Exception;
use mysqli;

class MySqliDriver implements IDriver
{

    private $connection;

    public function __construct($host, $database, $user, $password, $port, $charset)
    {
        $this->connection = new mysqli($host, $user, $password, $database, $port);
        $this->connection->set_charset($charset);
        if ($this->connection->connect_errno) {
            $error = sprintf("Mysql error %s : %s",
                $this->connection->connect_errno,
                $this->connection->connect_error
            );
            throw new Exception($error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function find($table, $id = null)
    {
        // TODO: Implement find() method.
    }

    public function insert($table, $data)
    {
        // TODO: Implement insert() method.
    }

    public function update($table, $data, $condition, $comparator = 'AND')
    {
        // TODO: Implement update() method.
    }

    public function delete($table, $id)
    {
        // TODO: Implement delete() method.
    }

    public function __destruct()
    {
       $this->connection->close();
    }
}