<?php

namespace application\libraries;

interface IDriver
{
    public function __construct($host, $database, $user, $password, $port, $charset);

    public function getConnection();

    public function find($table, $id = null);

    public function insert($table, $data);

    public function update($table, $data, $condition, $comparator = 'AND');

    public function delete($table, $id);

    public function __destruct();
}