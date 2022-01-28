<?php
include('header.php');

if (!isset($_SESSION["pseudo"])) {
    header("Location: .");
}


    $connexion = new PDO(
        "mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8",
        "root",
        ""
    );

    $requete = $connexion->prepare(
        'SELECT * FROM tache'

    );



    $requete->execute();

    $listeTache = $requete->fetchAll();


    ?>
<div class="container">
    <a class="btn btn-success" href="ajouter-tache.php">Ajouter une tache</a>
    <div class="row">
        
    <?php
    
    foreach($listeTache as $tache){



?>


<div class="col-4">
<div class="card text-white bg-primary mb-3">
    <div class="card-header">
        <a href="supprimer-tache.php?id=<?= $tache["id"] ?>" class="btn btn-danger">
        <i class="fas fa-trash"></i>
    </a>
        <a href="modifier-tache.php?id=<?= $tache["id"] ?>" class="btn btn-danger">
        <i class="fas fa-edit"></i>
    </a>
    </div>
    <div class="card-body">
        <h4 class="card-title"><?= $tache["titre"] ?></h4>
        <p class="card-text"><?= $tache["contenu"] ?></p>
    </div>
</div>
</div>
<?php } ?>
</div>
</div>
<?php
include('footer.php');

?>