<?php

$servername = "localhost"; // Database host
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "bddpartynextdoor"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if (isset($_POST['nom_utilisateur']) && isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
    // Retrieve and sanitize user inputs
    $nom_utilisateur = $conn->real_escape_string($_POST['nom_utilisateur']);
    $email = $conn->real_escape_string($_POST['email']);
    $mot_de_passe = $conn->real_escape_string($_POST['mot_de_passe']);

    // Insert the data into the database
    $sql = "INSERT INTO Utilisateur (nom_utilisateur, email, mot_de_passe) 
            VALUES ('$nom_utilisateur', '$email', '$mot_de_passe')";

    if ($conn->query($sql) === TRUE) {
        echo "Votre nom est " . htmlspecialchars($nom_utilisateur) . ", et il a été ajouté à la base de données.";
    } else {
        echo "Erreur: " . $conn->error;
    }
} else {
    echo "Tous les champs sont requis.";
}

// Close the connection
$conn->close();

?>
