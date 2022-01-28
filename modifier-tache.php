<?php 
include("header.php");


$connexion = new PDO(
    "mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8",
    "root",
    ""
);

$requete = $connexion->prepare(
    'SELECT * FROM tache WHERE id = ?'
);



$requete->execute(
    [
        $_GET['id']
    ]
);
 $tache = $requete->fetch();

 if(isset($_POST['valider'])){
    $requete = $connexion->prepare(
        'UPDATE tache SET titre = ?, contenu = ? WHERE id = ?'
    );
    
    
    
    $requete->execute(
        [
            $_POST['titre'],
            $_POST['contenu'],
            $_GET['id']
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
        <input name="titre" type="text" class="form-control" id="titre" value="<?= $tache['titre'] ?>">
    </div>
    <div class="form-group">
        <label for="contenu" class="form-label mt-4">Contenu de la tache</label>
        <textarea name="contenu" class="form-control" id="contenu" rows="4"><?= $tache["contenu"] ?></textarea>
    </div>
    <div class="d-flex justify-content-between">
    <a class="btn btn-warning" href="./liste.php">Retour</a>
    <input class="btn btn-success" type="submit" value="Enregistrer" name="valider">
    </div>
</form>
</div>
</div>


<?php 
include("footer.php");

?>