<?php
// Paramètres de connexion
$host = 'localhost';
$dbname = 'gestion_etudiants';
$user = 'root';
$pass = ''; // Par défaut vide sur XAMPP/WAMP

try {
    // Utilisation de PDO comme demandé [cite: 66]
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>