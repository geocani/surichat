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

<a href="deconnexion2.php">R E T O U R</a>

<?php 
echo $user_info['avatar'];

?>
<br><br>
<div class="logo_main">
    <img src="img/logo_color1.svg" width="20%" alt="logo">
</div>
<br><br>
<!-- <h1>Surichat</h1> -->

<div class="container">
    <div class="row">
        <!-- CHAT -->
        <div class="col-md-9"> 
            <h3>CHAT</h3>
            <div class="chat">
                <div class="row">
                    <div class="col-md-12 bt">
                        <div class="send_msg msg">
                            <form action="">
                                <input type="text" class="inp_send_msg" name="send_msg" id="" placeholder="Ecrivez votre message ici">
                                <input type="submit" name="" id="" value="ENVOYER">
                            </form>
                        </div> 
                    </div>
                </div>

            </div>
        </div>
        <!-- ONLINE -->
        <div class="col-md-3"> 
            <h3>ONLINE</h3>
            <div class="online">
            </div>
        </div>
    </div>
    <div class="row">
        <!-- PROFIL -->
        <div class="col-md-12"> 
            <h3>Votre Profil</h3>
            <a href="edit_profil2.php<?php echo '?id=' .$user_id ?>">Editer</a>
            <div class="cont-profil">
                <div class="profil">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>SURIKATE</h3>
                            <div class="avat">
                                <img src="membres/avatars/<?php echo $user_info['avatar']; ?> " alt="" width="100px">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p><span class="bold">Nom:</span> <?php echo $user_info['nom']; ?></p>
                            <p><span class="bold">Prenom:</span> <?php echo $user_info['prenom']; ?></p>
                            <p><span class="bold">Age:</span> <?php echo $user_info['age']; ?></p>
                            <p><span class="bold">Genre:</span> <?php echo $user_info['genre']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><span class="bold">un:</span> <?php echo $user_info['login']; ?></p>
                            <p><span class="bold">deux:</span> <?php echo $user_info['email']; ?></p>
                            <p><span class="bold">trois:</span> trois</p>
                            <p><span class="bold">quatre:</span> quatre</p>
                        </div>
                    </div>
                </div>
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