<?php
$path = __DIR__ . '/database.sqlite' ;
if (file_exists($path)) unlink($path);

$pdo = new PDO("sqlite:$path");
$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

$query = $pdo->prepare("CREATE TABLE users (
    id INTEGER PRIMARY KEY , 
    email VARCHAR(255) NOT NULL , 
    pass VARCHAR(255) NOT NULL )"
    );

$query2 = $pdo->prepare("CREATE TABLE sites (
        id INTEGER PRIMARY KEY , 
        lien TEXT(255) NULL ,
        nom VARCHAR(255) NULL )"
        );

$query->execute();
$query2->execute();