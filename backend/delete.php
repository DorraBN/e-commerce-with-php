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

    $sql = "DELETE FROM produits WHERE id = ?";
 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Enregistrement supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Aucun identifiant fourni.";
}

$conn->close();
?>
