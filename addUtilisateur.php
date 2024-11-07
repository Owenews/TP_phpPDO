<?php

//include('db.php');

try {
    // Connexion à la base de données
    $base = new PDO("mysql:host=127.0.0.1; dbname=supdevinci", 'root', '');
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nom = ($_POST['nom']);
        $prenom = ($_POST['prenom']);
        $tel = ($_POST['tel']);

        // Requête SQL pour ajouter un utilisateur
        $sql = "INSERT INTO personne (nom, prenom, tel) VALUES (:nom, :prenom, :tel)";
        $req = $base->prepare($sql);

        // Lier les paramètres
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':tel', $tel);

        // Exécuter la requête
        $req->execute();

        echo "Utilisateur créé avec succès !<br>";
    }

    ?>
    <h2>Créer un nouvel utilisateur</h2>
    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom"><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom"><br>

        <label for="tel">Téléphone :</label>
        <input type="text" name="tel" id="tel"><br>

        <input type="submit" value="Créer">
    </form>
    <?php

} catch (Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
