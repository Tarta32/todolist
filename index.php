<?php


include("header.php");

if (isset($_SESSION["pseudo"])) {
    header("Location: liste.php");
}

$erreurLogin = false;

if (isset($_POST['valider'])) {

    $connexion = new PDO(
        "mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8",
        "root",
        ""
    );

    $requete = $connexion->prepare(
        'SELECT * FROM utilisateur WHERE pseudo = ?'

    );



    $requete->execute(
        [
            $_POST['pseudo']
        ]
    );

    $utilisateur = $requete->fetch();

    if ($utilisateur) {


        if (password_verify($_POST["mdp"], $utilisateur['mdp'])) {
            $_SESSION['pseudo'] = $_POST['pseudo'];
            header("Location: liste.php");
        } else {
            $erreurLogin = true;
        }
    } else {
        $erreurLogin = true;
    }
}


?>

<?php
if ($erreurLogin) {
?>
    <div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Mauvais login / mot de passe</h4>
        <p class="mb-0">Ce compte n'existe pas !</p>
    </div>
<?php
}

?>

<form action="" method="POST">
    <div class="container">
        <div class="form-group">
            <label class="col-form-label mt-4" for="pseudo">Pseudo</label>
            <input name="pseudo" type="text" class="form-control" placeholder="Ex : JeanDupont" id="pseudo" value="<?php if (isset($_POST["pseudo"]))echo $_POST["pseudo"];?>">
        </div>
        <div class="form-group">
            <label class="col-form-label mt-4" for="mdp">Mot de passe</label>
            <input name="mdp" type="password" class="form-control" id="mdp">
        </div>
        <input class="btn btn-success mt-3" type="submit" value="Se connecter" name="valider">
        <a href="inscription.php" class="btn btn-primary mt-3">Inscription</a>
    </div>
</form>
<?php
include('footer.php');

?>