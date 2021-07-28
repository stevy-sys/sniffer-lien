

<?php include('../header.php') ?>





<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = __DIR__ . './../database/database.sqlite' ;
    $pdo = new PDO("sqlite:$path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $query = $pdo->prepare(
        'INSERT INTO users (email,pass) VALUES (? , ?)'
    );
    
    $query->execute([$_POST['email'],$_POST['pass']]);
    header("Location: login.php");
    exit();
}

?>





<h1>REGISTER</h1>

<form method="post">

<p>
    <input type="text" name="email" id="">
</p>
<p>
    <input type="text" name="pass" id="">
</p>
<p>
    <input type="text" name="confirm-password" id="">
</p>
<p>
    <input type="submit" value="connexion">
</p>

</form>

<?php include('../footer.php') ?>