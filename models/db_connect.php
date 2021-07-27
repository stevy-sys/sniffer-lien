<?php

abstract class Model {
    private static $_bdd ;

    private function setBdd(Type $var = null)
    {
        self::$_bdd = new  PDO ('mysql:host=localhost;db_name=site_sniffer;charset=utf-8','root');

        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if(self::$_bdd == null) {
            self::setBdd();
            return self::$_bdd;
        }
    }

    protected function getAll($table,$obj)
    {
        $this->getBdd;
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM '.$table.' ORDER BY id desc');
        $req->execute();

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var = new $obj($data);
        }
        return $var ;
        $req->closeCursor();
    }
}