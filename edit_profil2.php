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

    // NEW AVATAR
    // if(isset($_POST['submit_avatar'])){
    //     if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

    //         $taille_max = 2097152;
    //         $extention_valide = array('jpg', 'jpeg', 'gif', 'png');

    //         if($_FILES['avatar']['size'] <= $taille_max){ // VERIF TAILLE
    //             $extention_uploade = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); // VERIF EXTENTION
    //             if(in_array($extention_uploade, $extention_valide)){ // in_array -> si dans le tableau
    //                 $chemin_avatar = "membres/avatars/" .$_SESSION['id']. "." .$extention_uploade; // Renomer le fichier par ID
    //                 $deplacement = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin_avatar ); // DEPLACEMENT vers dossier de reception
    //                 if($deplacement){

    //                     $insert_avatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id ');
    //                     $insert_avatar-> execute(array(
    //                         'avatar' => $_SESSION['id'].".".$extention_uploade,
    //                         'id' => $_SESSION['id']
    //                     ));
    //                     header('location: profil.php?id='.$_SESSION['id']);

    //                 }else{
    //                     echo "ERREUR";
    //                 }
    //             }else{
    //                 echo "pas bon format";
    //             }
    //         }else{
    //             echo "Fichier trop grand";
    //         }
    //     }
    // }else{
    //     echo "ERREUR - Avatar";
    // }


    if (isset($_POST['new_submit'])){
        // NEW LOGIN
        if(isset($_POST['new_login']) AND !empty($_POST['new_login']) AND $_POST['new_login'] != $user['login']){
            $insert_pseudo = $bdd->prepare("UPDATE membres SET login = ? WHERE id = ? ");
            $insert_pseudo->execute(array($_POST['new_login'], $_SESSION['id']));
            header('location: profil.php?id='.$_SESSION['id']);
        }else{
            echo "pas ok";
        }
        // NEW MAIL
        if(isset($_POST['new_email']) AND !empty($_POST['new_email']) AND $_POST["new_email"] != $user['email']){
            $insert_email = $bdd->prepare("UPDATE membres SET email = ? WHERE id = ? ");
            $insert_email->execute(array($_POST['new_email'], $_SESSION['id']));
            header('location: profil.php?id='.$_SESSION['id']);
        }else{
            echo "pas ok";
        }
        // NEW NOM
        if(isset($_POST['new_nom']) AND !empty($_POST['new_nom'])){ //AND $_POST["new_nom"] != $user['nom']){
            $insert_email = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ? ");
            $insert_email->execute(array($_POST['new_nom'], $_SESSION['id']));
            header('location: profil.php?id='.$_SESSION['id']);
        }else{
            echo "pas ok";
        }
        // NEW PRENOM
        if(isset($_POST['new_prenom']) AND !empty($_POST['new_prenom'])){ //AND $_POST["new_nom"] != $user['nom']){
            $insert_email = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ? ");
            $insert_email->execute(array($_POST['new_prenom'], $_SESSION['id']));
            header('location: profil.php?id='.$_SESSION['id']);
        }else{
            echo "pas ok";
        }
        // NEW AGE
        if(isset($_POST['new_age']) AND !empty($_POST['new_age'])){ //AND $_POST["new_nom"] != $user['nom']){
            $insert_email = $bdd->prepare("UPDATE membres SET age = ? WHERE id = ? ");
            $insert_email->execute(array($_POST['new_age'], $_SESSION['id']));
            header('location: profil.php?id='.$_SESSION['id']);
        }else{
            echo "pas ok";
        }
        // NEW GENRE
        if(isset($_POST['new_genre']) AND !empty($_POST['new_genre'])){ //AND $_POST["new_nom"] != $user['nom']){
            $insert_email = $bdd->prepare("UPDATE membres SET genre = ? WHERE id = ? ");
            $insert_email->execute(array($_POST['new_genre'], $_SESSION['id']));
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
                    <div class="avatar">
                        <!-- <img src="membres/avatars/<?php echo $user_info['avatar']; ?> " alt="" width=100px> -->
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="avatar" id="">
                        <input type="submit" name="submit_avatar" id="">
                    </form>
                    <br>
                    <form action="" method="POST">
                        <label for="">Login: </label>
                        <input type="text" name="new_login" id="" placeholder="Nouveau login" value="<?php echo $user['login'];?>"><br><br><br><br>
                        <label for="">Email: </label>
                        <input type="text" name="new_email" id="" placeholder="Nouvel email" value="<?php echo $user['email'];?>"><br><br><br><br>
                        <label for="">Ancien pass: </label>
                        <input type="text" name="new_pass1" id="" placeholder="*******"><br><br><br><br>
                        <label for="">Nouveau pass: </label>
                        <input type="text" name="new_pass1" id="" placeholder="*******"><br><br><br><br>
                        <label for="">Confirmation: </label>
                        <input type="text" name="new_pass2" id="" placeholder="*******"><br><br><br><br>




                        <label for="">Nom: </label>
                        <input type="text" name="new_nom" id="" placeholder=""><br><br><br><br>

                        <label for="">Prenom: </label>
                        <input type="text" name="new_prenom" id="" placeholder=""><br><br><br><br>

                        <label for="">Age: </label>
                        <input type="number" name="new_age" id="" placeholder=""><br><br><br><br>

                        <label for="">Genre: </label>
                        <input type="text" name="new_genre" id="" placeholder=""><br><br><br><br>

                        <input type="submit" name="new_submit" id="">
                        <br>
                        <a href="profil2.php<?php echo '?id=' .$user_id ?>">RETOUR</a>
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