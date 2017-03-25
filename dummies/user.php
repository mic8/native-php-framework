<?php

class User
{
    private $conn = null;

    public function __construct(Connection $conn = null)
    {
        $this->conn = $conn;
    }

    public function all()
    {
        $users = $this->conn->query('select * from users');
        $arr = [];

        while($data = $users->fetch_assoc()) {
            array_push($arr, $data);
        }

        $this->toJson($arr);
    }

    private function toJson($data = [])
    {
        echo json_encode($data);
    }
}