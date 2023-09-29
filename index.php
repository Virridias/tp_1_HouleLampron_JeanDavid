<?php

$host = "localhost";
$db = "jdhoulelampron_tp1";
$user = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $oPDO = new PDO($dsn, $user, $password);

    if($oPDO){
        echo "Connected to the $db database successfully";
    }
} catch (PDOException $e) {
    echo $e -> getMessage();
}

//impotation des fichier de class

require_once './class/CRUD.php';
require_once './class/film.php';

//Crée un film
$filmOperator = new Film($host, $db, $user, $password);

$films = $filmOperator -> getFilm();
foreach ($films as $film){
    echo "ID: {$film['id']}, Titre: {$film['titre']}, Année de difusion: {$film['annee_difusion']}, Genre: {$film['genre']}, Directeur: {$film['directeur']}<br>";
}

//Utiliser le id pour trouver un film
$filmById = $filmOperator -> getFilmById(1);

print_r($filmById);

//Ajouter un nouveau film
$newFilmData = [
    'titre' => 'Le Seigneur des anneaux',
    'annee_difusion' => 2001,
    'genre' => 'fantastique',
    'directeur' => 'Peter Jackson'
];

echo "<br><br>";

$filmOperator -> ajouterFilm($newFilmData);
echo "Nouveau film a ete ajouter avec succès !!!<br>";

//Modifier un film

$idToEdit = 2;
$updateFilmData = [
    'genre' => 'action'
];

$filmOperator -> updateFilmById($idToEdit, $updateFilmData);
echo "Le film avec le ID : $idToEdit modifié avec succès <br>";

//suprimer un film 

$idToDelete = 3;
$filmOperator -> deleteFilm($idToDelete);
echo "Le film avec le ID : $idToDelete a été suprimé avec succès <br>";

//Terminer la connexion a la base de données
unset($filmManager);
?>