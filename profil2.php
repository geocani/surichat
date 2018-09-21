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

$bdd = new PDO("mysql: host=localhost; dbname=surichat; charset=utf8", "root", "");





$user_id = $_GET['id'];

if ($user_id == $_SESSION['id']){ // Vérifie si l'id en GET est bien celui de la SESSION

$requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
$requser->execute(array($user_id));
$user_info = $requser->fetch();

}else{
    echo "non";
}






?>


<br><br>
<div class="logo_main">
    <img src="img/logo_color1.svg" width="20%" alt="logo">
</div>
<br><br>
<!-- <h1>Surichat</h1> -->
<br><br><br>
<div class="container">
    <div class="row"> 
        <!-- Card 1 -->
            <div class="card card_profil">
                <div class="card-header">
                    <h2>Profil de <?php echo $user_info['login']; ?></h2>
                </div>
                <div class="card-body">
                    <div class="login_suri">
                        <div class="avatar">
                            <img src="membres/avatars/<?php echo $user_info['avatar']; ?> " alt="" width=100px>
                        </div>
                        <br>
                        <p><strong>Nom:</strong><?php echo $user_info['nom']; ?></p>
                        <p><strong> Prénom:</strong><?php echo $user_info['prenom']; ?></p>
                        <p><strong>Age:</strong><?php echo $user_info['age']; ?></p>
                        <p><strong>Genre:</strong><?php echo $user_info['genre']; ?></p>
                        <p><strong>Pseudo:</strong> <?php echo $user_info['login']; ?></p>
                        <p><strong>Mail:</strong> <?php echo $user_info['email']; ?></p>
                        <a href="deconnexion2.php">DECONNEXION</a> <br>
                        <a href="edit_profil2.php<?php echo '?id=' .$user_id ?>">Editer son profil</a>
                    </div>
                </div>
            </div>
        <!-- End Card 1 -->
        
        <?php if (isset($erreur)){ echo "<p class='erreur'>" . $erreur . "</p>"; }; ?>
        <?php if (isset($succses)){ echo "<p class='succses'>" . $succses . "</p>"; }; ?>
    </div>
</div>




<div class="container">
    <div class="row"> 
        <!-- CARD 1 -->
        <div class="col-md-6">
            <h3>Connexion</h3>
            <div class="con">
                <div class="login_suri">
                    <form action="" method="POST">
                        <input type="text" class="log_ok" name="log_ok" id="logOk" placeholder="Login">
                        <input type="password" class="pass_ok" name="pass_ok" id="passOk" placeholder="password">
                        <div class="div">
                            <input type="submit" class="submit_log" name="login_ok" id="loginOk" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- CARD 2 -->
        <div class="col-md-6">
            <h3>Inscription</h3>
            <div class="con">
                <div class="login_suri">
                    <form action="" method="POST">
                        <input type="text" class="log_inscription" name="inscription_log" id="logOk" placeholder="Login">
                        <input type="text" class="mail_inscription" name="inscription_email" id="passOk" placeholder="Email">
                        <input type="password" class="pass1_inscription" name="inscription_mdp1" id="passOk" placeholder="password"> 
                        <input type="password" class="pass2_inscription" name="inscription_mdp2" id="passOk" placeholder="Confirm"> 
                        <div class="div">
                            <input type="submit" class="submit_log" name="inscription" id="inscription" value="Inscription">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <div class="row">
        <!-- COPY -->
        <div class="col-md-12"> 
            <div class="copy">
                <p>SuriKate - SuriChat - 2018 - Contact </p>
            </div>
        </div>
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