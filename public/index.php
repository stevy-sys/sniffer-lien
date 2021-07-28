<?php include('../header.php') ?>
<?php 
function fetchSite($site) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.scraperapi.com/?api_key=661a59050494837dd93bcf7baaa1f841&url=http://'.$site,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'access_key: ef6e07baf41f6bc0e70416ebc42433'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return (String) $response;
}

function allSite()
{
    $path = __DIR__ . './../database/database.sqlite' ;
        
        $pdo = new PDO("sqlite:$path");
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);

        $query = $pdo->prepare("SELECT * FROM `sites`");
        $resultat = $query->execute();
        if($resultat){
            return $query->fetchAll();
        }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = __DIR__ . './../database/database.sqlite' ;
    $sites = fetchSite($_POST['site']);
    
    preg_match_all('/<a href="(.*?)">(.*?)<\/a>/s',$sites,$match);
    $lien = implode($match[0]);

    $pdo = new PDO("sqlite:$path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
    $query = $pdo->prepare(
        "INSERT INTO `sites` (`id`, `nom`, `lien`) VALUES (NULL, ?, ?)"
    );
    $query->execute([$_POST['site'],$lien]);
}


?>
<?php if (!isset($_SESSION['visiteur'])) { ?>
    <h3>Connectez vous pour utiliser l'application</h3>
<?php } ?>

<?php if (isset($_SESSION['visiteur'])) { ?>
    <form method = "POST">
        <input name="site" type="texte" placeholder = "www.jeux.com">
        <input type="submit" value = "fetch">
    </form>

    <table>
        <tr>
            <td>site</td>
            <td>lien disponible</td>
        </tr>
        <tr>
        <?php
            $donn = allSite() ;
            foreach ($donn as $key) {
        ?>
            <td class="nom" ><?php print_r($key['nom']) ?></td>
            <td><?php print_r($key['lien']) ?></td>
        </tr>
        <?php } ?>
        
    </table>
<?php } ?>

<?php include('../footer.php') ?>