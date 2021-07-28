<?php include('../header.php') ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $path = __DIR__ . './../database/database.sqlite' ;
        
        $pdo = new PDO("sqlite:$path");
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);

        // SELECT * FROM `users` WHERE `email` LIKE 'stevy@gmail.com' AND `password` LIKE 'safidy1997'
        //$_POST['email']
        //$_POST['pass']
        $query = $pdo->prepare("SELECT * FROM `users` WHERE email= :email AND pass =:pass");
        $resultat = $query->execute([$_POST['email'],$_POST['pass']]);
        if($resultat){
            $_SESSION['visiteur'] = $query->fetch()['email'] ;
        }
        header("Location: index.php");
    exit();
    }
?>






<h1>LOGIN</h1>
<form method="post">
    <p>
        <input type="text" name="email" id="">
    </p>
    <p>
        <input type="text" name="pass" id="">
    </p>
    <p>
        <input type="submit" value="connexion">
    </p>

</form>
    

<?php include('../footer.php') ?>