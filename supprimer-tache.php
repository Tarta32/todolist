<?php 

$connexion = new PDO(
    "mysql:dbname=cci_todolist;host=localhost:3306;charset=UTF8",
    "root",
    ""
);

$requete = $connexion->prepare(
    'DELETE FROM tache WHERE id = ?'
);



$requete->execute(
    [
        $_GET['id']
    ]
);

header('Location: liste.php');

?>