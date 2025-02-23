<?php

$serverName="localhost";
$username="root";
$password="moisefofou";
$dbname="beauty_garden"; // Correction du nom de la base de données

$conn=new mysqli($serverName,$username,$password,$dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
} else {
  
}

?>
