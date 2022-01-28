<?php
include('header.php');

if(isset($_POST['valider'])){
    $connexion = new PDO(
        "mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8",
        "root",
        ""
    );

    $requete = $connexion->prepare(
        "INSERT INTO `tache` (`id`, `titre`, `contenu`) VALUES (NULL, ?, ?)"
    );



    $requete->execute(
        [
            $_POST['titre'],
            $_POST["contenu"]
        ]
    );

    header('Location: liste.php');
}
?>

<div class="row">
    <div class="col-5 mx-auto">
<form action="" method="POST">
    <div class="form-group">
        <label class="col-form-label mt-4" for="titre">Titre</label>
        <input name="titre" type="text" class="form-control" id="titre">
    </div>
    <div class="form-group">
        <label for="contenu" class="form-label mt-4">Contenu de la tache</label>
        <textarea name="contenu" class="form-control" id="contenu" rows="4"></textarea>
    </div>
    <div class="d-flex justify-content-between">
    <a class="btn btn-warning" href="./liste.php">Retour</a>
    <input class="btn btn-success" type="submit" value="Ajouter la tache" name="valider">
    </div>
</form>
</div>
</div>

<?php
include('footer.php')

?>