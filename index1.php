<?php
// Détails de la connexion à la base de données
$host = 'localhost';
$dbname = 'gestion_produits';
$username = 'root';
$password = ''; // Remplacer si nécessaire

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Insertion de données si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];

    // Requête d'insertion
    $sql = "INSERT INTO produits (nom, description, prix, quantite) VALUES (:nom, :description, :prix, :quantite)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nom' => $nom, 'description' => $description, 'prix' => $prix, 'quantite' => $quantite]);
    header("Location: index.php"); // Rediriger pour éviter la soumission multiple
    exit();
}

// Modification d'un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];

    // Requête de mise à jour
    $sql = "UPDATE produits SET nom = :nom, description = :description, prix = :prix, quantite = :quantite WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nom' => $nom, 'description' => $description, 'prix' => $prix, 'quantite' => $quantite, 'id' => $id]);
    header("Location: index.php"); // Rediriger après la modification
    exit();
}

// Suppression d'un produit
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $sql = "DELETE FROM produits WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    header("Location: index.php"); // Rediriger après suppression
    exit();
}

// Récupérer tous les produits
$sql = "SELECT * FROM produits";
$stmt = $pdo->query($sql);
$produits = $stmt->fetchAll();
?>