<?php
    try {
        $base = new PDO("mysql:host=127.0.0.1; dbname=supdevinci", 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for errors


        $resultat = $base->query('SELECT * from personne');

        $utilisateur = $resultat->fetchAll();

        echo "<br>";


        echo "Nombre d'utilisateur : " . $resultat->rowCount();

        echo "<br>";

        //$sql = "INSERT INTO personne(nom, prenom, tel) VALUES ('Jerome','Guilbau', 0459871562)";


        foreach ($utilisateur as $ligne) {
            echo "<p>";
            echo "Nom : " . ($ligne['nom']) . " | ";
            echo "Prenom : " . ($ligne['prenom']) . " | ";
            echo "Tel : " . ($ligne['tel']) . "<br>";
            echo "</p>";
        }
    }

    catch (Exception $e) {
        die('Connection failed: ' . $e->getMessage());
    }

?>



