<?php
// Connexion à la base de données
$host = 'localhost'; // ou l'adresse de votre serveur
$dbname = 'contact_form'; // nom de la base de données
$username = 'root'; // votre nom d'utilisateur MySQL
$password = ''; // votre mot de passe MySQL

// Créer une connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Préparer la requête SQL pour insérer les données
    $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";

    // Préparer la requête
    if ($stmt = $conn->prepare($sql)) {
        // Lier les paramètres
        $stmt->bind_param("sss", $name, $email, $message);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Le message a été envoyé avec succès!";
        } else {
            echo "Erreur : " . $stmt->error;
        }

        // Fermer la déclaration
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php
 ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h2>Contact</h2>
        <form action="send_email.php" method="post">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Envoyer</button>
</body>
</html>