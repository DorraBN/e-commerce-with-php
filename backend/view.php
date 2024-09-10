<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "e-commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM produits WHERE id = ?";
    

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
    
        while ($row = $result->fetch_assoc()) {
            echo "<h1>Détails de l'enregistrement</h1>";
            echo "<p>ID: " . htmlspecialchars($row["id"]) . "</p>";
            echo "<p>Nom: " . htmlspecialchars($row["nom"]) . "</p>";
            echo "<p>Description: " . htmlspecialchars($row["description"]) . "</p>";
            echo "<p>marque: " . htmlspecialchars($row["marque"]) . "</p>";
            echo "<p>Prix: " . htmlspecialchars($row["prix"]) . "</p>";
            // Ajoutez d'autres champs selon vos besoins
        }
    } else {
        echo "Aucun enregistrement trouvé.";
    }
    
    // Fermeture de la déclaration préparée
    $stmt->close();
} else {
    echo "Aucun identifiant fourni.";
}

// Fermeture de la connexion
$conn->close();
?>
