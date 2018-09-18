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
$user = $requser->fetch(); // WHILE pour plusieur donnée FETCH pour une donnée

    if (isset($_POST['new_submit'])){

        if(isset($_POST['new_login']) AND !empty($_POST['new_login']) AND $_POST['new_login'] != $user['login']){
        
            $insert_pseudo = $bdd->prepare("UPDATE membres SET login = ? WHERE id = ? ");
            $insert_pseudo->execute(array($_POST['new_login'], $_SESSION['id']));
            header('location: profil.php?id='.$_SESSION['id']);




        }else{
            echo "pas ok";
        }
    }else{
        echo "non";
    }
    
}else{
    echo "non";
}





?>



<!-- <h1>Surichat</h1> -->
<br><br><br>
<div class="container">
    <div class="row"> 
        <!-- Card 1 -->
            <div class="card card_profil">
                <div class="card-header">
                    <h2>Edition Profil de <?php echo $_SESSION['login']; ?></h2>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <label for="">Nouveau login: </label>
                        <input type="text" name="new_login" id="" placeholder="Nouveau login" value="<?php echo $user['login'];?>"><br>
                        <label for="">Nouveau email: </label>
                        <input type="text" name="new_email" id="" placeholder="Nouvel email" value="<?php echo $user['email'];?>"><br>
                        <label for="">Nouveau pass: </label>
                        <input type="text" name="new_pass1" id="" placeholder="*******"><br>
                        <label for="">Condirmation pass: </label>
                        <input type="text" name="new_pass2" id="" placeholder="*******"><br>
                        <input type="submit" name="new_submit" id="">
                    </form>
                </div>
            </div>
        <!-- End Card 1 -->
        
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