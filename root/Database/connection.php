<?php

namespace root\Database;
use root\Singleton;
use PDO;

class connection
{
    use Singleton;
    private $PDO;

    private function __construct()
    {
        $servername = "localhost";
        $dbname = "custommvc";
        $uname = "root";
        $password = "";

        $this->PDO = new PDO("mysql:host=$servername;dbname=$dbname", $uname, $password);
    }

    public function query($sql)
    {
        $result = $this->PDO->query($sql);
        if($result) {
          return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return null;
    }
}