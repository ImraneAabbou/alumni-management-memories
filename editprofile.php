<?php
include("connexionBD.php");
session_start();
$idmod = $_GET["id"];
if (!$_SESSION["nom"]){
    header("location:connexion.php");
    
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $password = $_POST["password"];

    $modifier = $connexion->prepare("UPDATE laureat SET nom=:nom, prenom=:prenom, email=:email, telephone=:tel, motdepasse=:password WHERE id=:id");
    $modifier->bindParam(':nom', $nom);
    $modifier->bindParam(':prenom', $prenom);
    $modifier->bindParam(':email', $email);
    $modifier->bindParam(':tel', $tel);
    $modifier->bindParam(':password', $password);
    $modifier->bindParam(':id', $idmod);
    $modifier->execute();
}

$list = $connexion->prepare("SELECT * FROM laureat WHERE id=:id");
$list->bindParam(':id', $idmod);
$list->execute();
$row = $list->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editprofile.css">
    <title>Editer- Coupains Avant</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="profile.php "><img src="images/ofpptlogo.svg" alt="" /></a>
        </div>
        <nav>
            <ul>
                <li><a href="profile.php"><img src="images/home-02.svg" alt=""></a></li>
                <li><a href="#"><img src="images/user-multiple.svg" alt=""></a></li>
                <li><a href="#"><img src="images/message-01.svg" alt=""></a></li>
            </ul>
        </nav>
        <div class="logout">
            <a href="deconnexion.php"><img src="images/logout-04.svg" alt=""></a>
        </div>
    </header>

    <section>
        <div class="left-side">
            <h2>Profil & Paramètres</h2>
            <div class="parametres">
                <a href="editprofile.php?id=<?php echo $idmod ?>"><img src="images/input.svg" alt=""><p style="color:#323232;">Info personnelles</p></a>
                <a href="editprofilepro.php?id=<?php echo $idmod ?>"><img src="images/input-vide.svg" alt=""><p>Info professionnelles</p></a>
                <a href="#"><img src="images/input-vide.svg" alt=""><p>Préférences</p></a>
                <a href="#"><img src="images/input-vide.svg" alt=""><p>Profils sociaux</p></a>
            </div>
        </div>
        <div class="right-side">
            <div class="title">
                <h2>Informations personnelles</h2>
                <p>Vous pouvez mettre à jour votre photo de profil et vos informations personnelles ici.</p>
            </div>
            <div class="photo-profile">
                <img width="120px" src="data:image/svg+xml;base64,<?php echo base64_encode($row->photoprofil); ?>" alt="photoprofil">
            </div>
            <div id="firstbreakline"></div>
            <form action="editprofile.php?id=<?php echo $idmod ?>" method="post">
                <div class="field">
                    <h4>Name</h4>
                    <input type="text" name="nom" id="nom" value="<?php echo $row->nom ?>">
                    <input type="text" name="prenom" id="prenom" value="<?php echo $row->prenom ?>">
                </div>
                <div class="breakline"></div>
                <div class="field">
                    <h4>Email</h4>
                    <input type="text" name="email" id="email" value="<?php echo $row->email ?>">
                </div>
                <div class="breakline"></div>
                <div class="field">
                    <h4>Telephone</h4>
                    <input type="tel" name="tel" id="tel" value="<?php echo $row->telephone ?>">
                </div>
                <div class="breakline"></div>
                <div class="field">
                    <h4>New password</h4>
                    <input type="password" name="password" id="password" value="<?php echo $row->motdepasse ?>">
                </div>
                <div class="breakline"></div>
                <div class="twobtns">
                    <input type="reset" value="Cancel">
                    <input type="submit" value="Update">
                </div>
            </form>
        </div>
    </section>
    <script>
    </script>

</body>