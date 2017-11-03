<?php
class Database
{
    private $mysqli;
    private $res;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        if (isset($this->mysqli)) {
            return $this->mysqli;
        } else {
            $this->mysqli = new mysqli(DB_HOST, DB_LOGIN, DB_PASS, DB_NAME);
            if ($this->mysqli->connect_error) {
                die('Ошибка подключения к базе данных (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
            }
        }
    }

    public function query($query)
    {
        if(empty($query)) {
            return false;
        }
        return $this->res = $this->mysqli->query($query);
    }

    public function results()
    {
        while ($result = $this->res->fetch_assoc()) {
            $results[] = $result;
        }
        return $results;
    }

    public function result()
    {
        return $this->res->fetch_assoc();
    }

    public function resId()
    {
        return $this->mysqli->insert_id;
    }
    
    public function __destruct()
    {
        $this->mysqli->close();
    }
}