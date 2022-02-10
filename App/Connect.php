<?php


namespace Desenv\Aula11;
include "./config.php";




class Connect
{

    protected $con;

    public function __construct()
    {

        $this->con = new \PDO(
            "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PWD
        );
    }


    protected function select(\PDOStatement $sth)
    {
        if($this->executeQuery($sth)){
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
    }


    protected function insert(\PDOStatement $sth){
        if($this->executeQuery($sth)){
            return $this->con->lastInsertId();
        }
    }

    protected function update(\PDOStatement $sth)
    {
        return $this->executeQuery($sth);
    }

    protected function executeQuery(\PDOStatement $sth){
        return $sth->execute();
    }


}