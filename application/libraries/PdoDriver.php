<?php

namespace application\libraries;

use PDO;

class PdoDriver implements IDriver
{

    private $connection;

    public function __construct($host, $database, $user, $password, $port, $charset)
    {
        $this->connection = new PDO("mysql:host={$host};dbname={$database};port={$port};charset={$charset}",
            $user,
            $password
        );
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function find($table, $id = null)
    {
        $query = sprintf("SELECT * FROM %s", $table);
        $params = [];
        if ($id != null) {
            $params = [
                ':id' => $id,
            ];
            $query .= " WHERE id=:id";
        }
        $queryPrepare = $this->getConnection()->prepare($query);
        $queryPrepare->execute($params);
        return $queryPrepare->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data)
    {
        $result = null;
        if (isset($data) && !empty($data)) {
            $fields = array_keys($data);
            $labels = array_map(function ($items) {
                return ":" . $items;
            }, $fields);

            $query = sprintf(
                "INSERT INTO %s (%s) VALUES (%s)",
                $table,
                implode(", ", $fields),
                implode(", ", $labels)
            );
            $queryPrepare = $this->getConnection()->prepare($query);

            if ($queryPrepare->execute(array_combine($labels, array_values($data))))
                $result = $this->getConnection()->lastInsertId();
        }
        return $result;
    }

    public function update($table, $data, $condition, $comparator = 'AND ')
    {
        $result = false;
        if (isset($data) && !empty($data)) {
            $comparator = " " . trim($comparator) . " ";
            $keys = array_keys($data);
            $dataMap = array_map(function ($items) {
                return $items . " = :" . $items;
            }, $keys);

            $conditionMap = [];
            foreach ($condition as $key => $value) {
                array_push($conditionMap, "{$key} = '{$value}' ");
            }

            $query = sprintf(
                "UPDATE %s SET %s WHERE %s",
                $table,
                implode(", ", $dataMap),
                implode($comparator, $conditionMap)
            );
            $queryPrepare = $this->getConnection()->prepare($query);
            $data = array_combine(
                array_map(
                    function ($key) {
                        return ":" . $key;
                    },
                    $keys
                ),
                array_values($data)
            );
            $result = $queryPrepare->execute($data);
        }
        return $result;
    }

    public function delete($table, $id)
    {
        $result = false;
        if ($id) {
            $query = sprintf("DELETE FROM %s WHERE id = :id", $table);
            $queryPrepare = $this->getConnection()->prepare($query);
            $queryPrepare->bindParam(":id", $id, PDO::PARAM_INT);
            $result = $queryPrepare->execute();
        }
        return $result;
    }

    public function login($table, $username, $password)
    {
        $query = sprintf("SELECT * FROM %s", $table);
        $password=md5($password);

        $params = [
            ':username' => $username,
            ':password' => $password,
        ];
        $query .= " WHERE username=:username AND password=:password";

        $queryPrepare = $this->getConnection()->prepare($query);
        $queryPrepare->execute($params);

        return $queryPrepare->fetch(PDO::FETCH_ASSOC);
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}