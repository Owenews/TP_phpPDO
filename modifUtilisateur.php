<?php

//include('db.php');

try {
    // Connexion à la base de données
    $base = new PDO("mysql:host=127.0.0.1; dbname=supdevinci", 'root', '');
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id']) && ($_GET['id'])) {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $new_nom = ($_POST['nom']);
            $new_prenom = ($_POST['prenom']);
            $new_tel = ($_POST['tel']);

            // Requête SQL pour modifier l'utilisateur
            $sql = "UPDATE personne SET nom = :nom, prenom = :prenom, tel = :tel WHERE id = :id";
            $req = $base->prepare($sql);

            // Lier les paramètres
            $req->bindParam(':nom', $new_nom);
            $req->bindParam(':prenom', $new_prenom);
            $req->bindParam(':tel', $new_tel);
            $req->bindParam(':id', $id, PDO::PARAM_INT);

            $req->execute();

            echo "Utilisateur mis à jour avec succès !<br>";
        }

            $sql = "SELECT * FROM personne WHERE id = :id";
        $req = $base->prepare($sql);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();

        // Récupérer les résultats
        $utilisateur = $req->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur) {
            ?>
            <h2>Modifier l'utilisateur</h2>
            <form method="POST">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" value="<?php echo ($utilisateur['nom']); ?>" ><br>

                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" value="<?php echo ($utilisateur['prenom']); ?>" ><br>

                <label for="tel">Téléphone :</label>
                <input type="text" name="tel" id="tel" value="<?php echo ($utilisateur['tel']); ?>" ><br>

                <input type="submit" value="Mettre à jour">
            </form>
            <?php
        } else {
            echo "Utilisateur introuvable.";
        }

    } else {
        echo "ID non valide ou non fourni.";
    }

} catch (Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
La meme chose pour supprimer un utilisateur via son id