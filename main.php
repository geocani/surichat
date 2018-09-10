<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel='stylesheet' href='css/style-main.css'>
    <script src='https://code.jquery.com/jquery-3.3.1.js' integrity='sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60='crossorigin='anonymous'></script>

    <title>TITRE</title>
</head>
<body>
<style>


</style>

<?php
// BDD
$bdd = new PDO("mysql: host=localhost; dbname=surichat; charset=utf8", "root", "");




if (isset($_POST['inscription'])){
    if (!empty($_POST['inscription_log']) AND !empty($_POST['inscription_email']) AND !empty($_POST['inscription_mdp1']) AND !empty($_POST['inscription_mdp2'])){

        // SANITISATION
        $login = htmlspecialchars($_POST['inscription_log']);
        $strlen_login = strlen($login);
        $email = filter_var($_POST['inscription_email'], FILTER_SANITIZE_EMAIL);
        $mdp1 = sha1($_POST['inscription_mdp1']);
        $mdp2 = sha1($_POST['inscription_mdp2']);

        if ($strlen_login <= 50){
            if ($mdp1 === $mdp2){
                // if (true === filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //     $insertmembre = $bdd->prepare("INSERT INTO membres(login, pass, email) VALUES(?, ?, ?)");
                //     $insertmembre->execute(array($login, $email, $mdp1));
                //     $succes = "Vous êtes correctement inscrit!";
                // } else {
                //     $erreur = "Email non valide";
                // }
                    $insertmembre = $bdd->prepare("INSERT INTO membres(login, pass, email) VALUES(?, ?, ?)");
                    $insertmembre->execute(array($login, $mdp1, $email));
                    $succses = "Vous êtes correctement inscrit!";
            }else{
                $erreur = "Vos mots de passe ne sont pas identique.";
            }
        }else{
            $erreur = "Votre pseudo ne doit pas depasser 50 caractères.";
        }
    }else{
        $erreur = "Vous devez remplire tout les champs.";
    }
}



?>



<br><br><br>
<div class="container">
    <div class="row"> 
        <!-- Card 1 -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Connexion</h2>
                </div>
                <div class="card-body">
                    <div class="login_suri">
                        <form action="" method="POST">
                            <input type="text" class="log_ok" name="log_ok" id="logOk" placeholder="Login">
                            <input type="text" class="log_ok" name="pass_ok" id="passOk" placeholder="password">
                            <input type="submit" class="log_ok" name="login_ok" id="loginOk" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card 1 -->
        <!-- Card 2 -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Inscription</h2>
                </div>
                <div class="card-body">
                    <div class="login_suri">
                        <form action="" method="POST">
                            <input type="text" class="log_50" name="inscription_log" id="logOk" placeholder="Login">
                            <input type="text" class="log_50" name="inscription_email" id="passOk" placeholder="Email">
                            <input type="text" class="log_50" name="inscription_mdp1" id="passOk" placeholder="password"> 
                            <input type="text" class="log_50" name="inscription_mdp2" id="passOk" placeholder="Confirm password"> 
                            <input type="submit" class="log_ok" name="inscription" id="inscription" value="Inscription">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card 2 -->
        <?php if (isset($erreur)){ echo "<p class='erreur'>" . $erreur . "</p>"; }; ?>
        <?php if (isset($succses)){ echo "<p class='succses'>" . $succses . "</p>"; }; ?>
    </div>
</div>













    



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src='js/script.js'></script>
<script>

</script>
</body>
</html>