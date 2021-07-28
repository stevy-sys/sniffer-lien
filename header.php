<?php session_start(); ?>
<?php if (isset($_SESSION['visiteur'])) { ?>
    <p><?= $_SESSION['visiteur'] ?></p>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>

        .nom {
            margin:200px;
            background-color:yellow;
        }

    </style>
</head>
<body>

<?php if (!isset($_SESSION['visiteur'])) { ?>
    <a href="/login.php">login</a>
    <a href="/register.php">register</a>
<?php } ?>

<?php if (isset($_SESSION['visiteur'])) { ?>
    <a href="/index.php">home</a>
    <a href="/deconnexion.php">deconnexion</a>
<?php } ?>

  

 