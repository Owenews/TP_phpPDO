<?php

//include('db.php');

try {
    // Connexion à la base de données
    $base = new PDO("mysql:host=127.0.0.1; dbname=supdevinci", 'root', '');
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour obtenir tous les utilisateurs
    $sql = "SELECT * FROM personne";
    $req = $base->prepare($sql);
    $req->execute();

    // Récupérer tous les résultats
    $utilisateurs = $req->fetchAll(PDO::FETCH_ASSOC);

    if ($utilisateurs) {
        echo "<h2>Liste des utilisateurs</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>";

        // Affichage des utilisateurs dans un tableau
        foreach ($utilisateurs as $utilisateur) {
            echo "<tr>
                    <td>" . ($utilisateur['id']) . "</td>
                    <td>" . ($utilisateur['nom']) . "</td>
                    <td>" . ($utilisateur['prenom']) . "</td>
                    <td>" . ($utilisateur['tel']) . "</td>
                    <td>
                        <a href='modifUtilisateur.php?id=" . $utilisateur['id'] . "'>Modifier</a> |
                        <a href='deleteUtilisateur.php?id=" . $utilisateur['id'] . "'>Supprimer</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun utilisateur trouvé.";
    }

} catch (Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>
