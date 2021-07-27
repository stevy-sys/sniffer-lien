<?php

class UserManager extends db_connect {
    public function getAll()
    {
        return $this->getAll('users','User');
    }   
}