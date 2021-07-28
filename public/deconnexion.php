<?php

$_SESSION['visiteur'] = null;
setcookie('PHPSESSID', '', 0);

header("Location: index.php");
exit();