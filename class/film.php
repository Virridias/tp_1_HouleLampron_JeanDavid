<?php

class film extends CRUD
{

    /** Récuperation de tous les jeux de la table jeu
     * 
     * @return array
     */

    public function getFilm()
    {
        //Récuperation de l'objet PDO de connexion
        global $oPDO;
        //Execution de la requete SQL passé en paramètre
        $oPDOStmt = $oPDO->query("SELECT id,titre,annee_difusion,genre,directeur FROM film ORDER BY id ASC");

        $films = $oPDOStmt->fetchAll(PDO::FETCH_ASSOC);
        return $films;
    }


    /**
     * @param int $id
     * @return array or boolean false (si aucun resultat)
     */
    public function getFilmById($id)
    {
        global $oPDO;
        $oPDOStmt = $oPDO->prepare("SELECT id,titre,annee_difusion,genre,directeur FROM film where id = :id");
        $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);

        //execution de la requete
        $oPDOStmt->execute();

        //recuperation de resultat
        $film = $oPDOStmt->fetchAll(PDO::FETCH_ASSOC);
        return $film;
    }


    public function ajouterFilm($film)
    {
        global $oPDO;
        try {
            //preparation de la requete
            $oPDOStmt = $oPDO->prepare('INSERT INTO film SET titre=:titre, annee_difusion=:annee_difusion, genre=:genre, directeur=:directeur');
            $oPDOStmt->bindParam(':titre', $film['titre'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':annee_difusion', $film['annee_difusion'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':genre', $film['genre'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':directeur', $film['directeur'], PDO::PARAM_INT);

            //execution de la requete
            $oPDOStmt->execute();
            return $oPDO->lastInsertId();
        } catch (PDOException $e) {
            // Gérer les erreurs PDO ici
            return false;
        }
    }




    //Method updateLivre
    public function UpdateFilmById($id, $data)
    {
        global $oPDO;

        try {
            $oPDOStmt = $oPDO->prepare('UPDATE film SET titre=:titre, annee_difusion=:annee_difusion, genre=:genre, directeur=:directeur WHERE id=:id');
            $oPDOStmt->bindParam(':titre', $data['titre'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':annee_difusion', $data['annee_difusion'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':genre', $data['genre'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':directeur', $data['directeur'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);

            $oPDOStmt->execute();

            // Vérifiez si la mise à jour a réussi
            if ($oPDOStmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {

            return false;
        }
    }



    //Method deleteLivre
    public function deleteFilm($id)
    {
        global $oPDO;

        $oPDOStmt = $oPDO->prepare("DELETE FROM film WHERE id=:id");
        $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);

        $resultat = $oPDOStmt->execute();

        if ($resultat) {
            echo "Film supprimé correctement <br><br>";
        } else {
            echo "une erreur est survenue";
        }
    }
}