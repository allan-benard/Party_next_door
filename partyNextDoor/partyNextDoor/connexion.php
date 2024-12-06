<?php
// Database connection details
$host = 'localhost';
$dbname = 'bddpartynextdoor';
$dbuser = 'root'; // Change if using a different database username
$dbpass = ''; // Enter your password if required

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = $_POST['username'] ?? '';
    $mot_de_passe = $_POST['password'] ?? '';

    if (!empty($nom_utilisateur) && !empty($mot_de_passe)) {
        // Query to fetch user by `nom_utilisateur`
        $stmt = $pdo->prepare("SELECT * FROM users WHERE nom_utilisateur = :nom_utilisateur");
        $stmt->execute(['nom_utilisateur' => $nom_utilisateur]);
        $user = $stmt->fetch();

        // Verify the password
        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            echo "Connexion réussie ! Bienvenue, " . htmlspecialchars($user['nom_utilisateur']) . ".";
            // Redirect to another page if needed
            // header("Location: event.html");
            // exit;
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>
