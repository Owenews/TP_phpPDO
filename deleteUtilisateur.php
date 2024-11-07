<?php

//include('db.php');

try {
    // Connexion à la base de données
    $base = new PDO("mysql:host=127.0.0.1; dbname=supdevinci", 'root', '');
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id']) && ($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['delete']) && $_POST['delete'] == 'yes') {
            // Requête SQL pour supprimer l'utilisateur
            $sql = "DELETE FROM personne WHERE id = :id";
            $req = $base->prepare($sql);
            $req->bindParam(':id', $id, PDO::PARAM_INT);

            $req->execute();

            echo "Utilisateur supprimé avec succès !<br>";
        } elseif (isset($_POST['delete']) && $_POST['delete'] == 'no') {
            echo "Suppression annulée.<br>";
        } else {
            echo "Êtes-vous sûr de vouloir supprimer cet utilisateur ?<br>";

            $sql = "SELECT * FROM personne WHERE id = :id";
            $req = $base->prepare($sql);
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();

            $utilisateur = $req->fetch(PDO::FETCH_ASSOC);

            if ($utilisateur) {
                echo "Nom : " . ($utilisateur['nom']) . "<br>";
                echo "Prénom : " . ($utilisateur['prenom']) . "<br>";
                echo "Téléphone : " . ($utilisateur['tel']) . "<br>";

                ?>
                <form method="POST">
                    <p>Voulez-vous vraiment supprimer cet utilisateur ?</p>
                    <input type="submit" name="delete" value="yes"> Oui
                    <input type="submit" name="delete" value="no"> Non
                </form>
                <?php
            } else {
                echo "Utilisateur introuvable.";
            }
        }
    } else {
        echo "ID non valide ou non fourni.";
    }

} catch (Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
