<?php
abstract class CRUD
{
    protected $pdo;
    public function __construct($host, $database, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    abstract public function getfilm();
    abstract public function getFilmById($id);
    abstract public function ajouterFilm($film);
    abstract public function updateFilmById($id, $data);
    abstract public function deleteFilm($id);
}