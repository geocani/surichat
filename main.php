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
session_start();
// INSCRIPTION
$bdd = new PDO("mysql: host=localhost; dbname=surichat; charset=utf8", "root", "");

if (isset($_POST['inscription'])){
    if (!empty($_POST['inscription_log']) AND !empty($_POST['inscription_email']) AND !empty($_POST['inscription_mdp1']) AND !empty($_POST['inscription_mdp2'])){

        // SANITISATION
        $login = htmlspecialchars($_POST['inscription_log']);
        $strlen_login = strlen($login);
        $email = filter_var($_POST['inscription_email'], FILTER_SANITIZE_EMAIL);
        // $mdp1 = sha1($_POST['inscription_mdp1']);
        // $mdp2 = sha1($_POST['inscription_mdp2']);
        $mdp1 = ($_POST['inscription_mdp1']);
        $mdp2 = ($_POST['inscription_mdp2']);

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
                    $succses_ins = "* Vous êtes correctement inscrit!";
            }else{
                $erreur_ins = "* Vos mots de passe ne sont pas identique.";
            }
        }else{
            $erreur_ins = "* Votre pseudo ne doit pas depasser 50 caractères.";
        }
    }else{
        $erreur_ins = "* Vous devez remplire tout les champs.";
    }
}
?>

<?php
// CONNEXION
if (isset($_POST['login_ok'])){
    if (!empty($_POST['log_ok']) AND !empty($_POST['pass_ok'])){

        $login_ok = htmlspecialchars($_POST['log_ok']);
        $pass_ok = ($_POST['pass_ok']);

        $requser = $bdd->prepare("SELECT * FROM membres WHERE login = ? AND pass = ?");
        $requser->execute(array($login_ok, $pass_ok));

        $user_exist = $requser->rowCount(); // Compte le nombre de rangée si il y en a

        if ($user_exist == 1){
            $user_info = $requser->fetch();
            $_SESSION['id'] = $user_info['id'];
            $_SESSION['login'] = $user_info['login'];
            $_SESSION['email'] = $user_info['email'];
            header("location: profil.php?id=".$_SESSION['id']);
        }else{
            $erreur_log = "* ERREUR login ou mot de passe";
        }

    }else{
        $erreur_log = "* ERREUR !!!!!!!!!!!!";
    }
}
?>


<!-- <h1>Surichat</h1> -->
<br><br>
<div class="logo_main">
    <img src="img/logo_color4.gif" width="20%" alt="logo">
</div>
<br><br>
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
                            <div class="div">
                                <input type="submit" class="submit_log" name="login_ok" id="loginOk" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ERREUR -->
            <div class="cont_erreur">
                <?php if (isset($erreur_log)){ echo "<p class='erreur'>" . $erreur_log . "</p>"; }; ?>
                <?php if (isset($succses)){ echo "<p class='succses'>" . $succses . "</p>"; }; ?>
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
                            <input type="text" class="log_inscription" name="inscription_log" id="logOk" placeholder="Login">
                            <input type="text" class="log_inscription" name="inscription_email" id="passOk" placeholder="Email">
                            <input type="text" class="log_inscription" name="inscription_mdp1" id="passOk" placeholder="password"> 
                            <input type="text" class="log_inscription" name="inscription_mdp2" id="passOk" placeholder="Confirm password"> 
                            <div class="div">
                                <input type="submit" class="submit_log" name="inscription" id="inscription" value="Inscription">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ERREUR -->
            <div class="cont_erreur">
                <?php if (isset($erreur_ins)){ echo "<p class='erreur'>" . $erreur_ins . "</p>"; }; ?>
                <?php if (isset($succses_ins)){ echo "<p class='succses'>" . $succses_ins . "</p>"; }; ?>
            </div>
        </div>
        <!-- End Card 2 -->
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