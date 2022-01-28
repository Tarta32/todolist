<?php
include('header.php');

$erreurConfirmerMdp = false;
$erreurMdpTropCourt = false;


if (isset($_POST['valider'])) {

    if(strlen($_POST['mdp']) < 5){
        $erreurMdpTropCourt = true;

    } else if ($_POST["mdp"] == $_POST['mdp2']) {
        $connexion = new PDO(
            "mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8",
            "root",
            ""
        );

        $requete = $connexion->prepare(
            "INSERT INTO `utilisateur` (`id`, `pseudo`, `mdp`) VALUES (NULL, ?, ?)"
        );



        $requete->execute(
            [
                $_POST['pseudo'],
                password_hash($_POST["mdp"], PASSWORD_BCRYPT)
            ]
        );

        header('Location: .');
    } else {
        $erreurConfirmerMdp = true;
    }
}
?>

<form action="" method="POST">
    <div class="container">
        <div class="form-group">
            <label class="col-form-label mt-4" for="pseudo">Pseudo</label>
            <input name="pseudo" type="text" class="form-control" placeholder="Ex : JeanDupont" id="pseudo" value="<?php if (isset($_POST["pseudo"])) echo $_POST["pseudo"] ?>">
        </div>
        <div class="form-group <?php if ($erreurMdpTropCourt) echo "has-danger" ?>">
            <label for="mdp" class="form-label mt-4">Mot de passe</label>
            <input name="mdp" type="password" class="form-control <?php if ($erreurMdpTropCourt) echo "is-invalid" ?>" id="mdp">
            <?php
            if ($erreurMdpTropCourt) {
            ?>
                <div class="invalid-feedback">Le mot de passe doit avoir au minimum 5 caractères</div>
            <?php
            }
            ?>
        </div>
        <div class="form-group <?php if ($erreurConfirmerMdp) echo "has-danger" ?>">
            <label class="col-form-label mt-4" for="mdp2">Confirmer le mot de passe</label>
            <input name="mdp2" type="password" class="form-control <?php if ($erreurConfirmerMdp) echo "is-invalid" ?>" id="mdp2">
            <?php
            if ($erreurConfirmerMdp) {
            ?>
                <div class="invalid-feedback">Les mots de passe ne correspondent pas</div>
            <?php
            }
            ?>
        </div>
        <!-- <div class="form-group has-danger">
            <label class="form-label mt-4" for="inputInvalid">Invalid input</label>
            <input type="text" value="wrong value" class="form-control is-invalid" id="inputInvalid">
            <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
        </div> -->


        <input class="btn btn-success mt-3" type="submit" value="S'inscrire" name="valider">
    </div>
</form>

<?php
include('footer.php');
?>