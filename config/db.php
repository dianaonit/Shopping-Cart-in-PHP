<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping_cart";

// deschide o noua conexiune cu serverul MySQL
$conn = mysqli_connect($servername, $username, $password , $dbname);

// se tipareste un mesaj si se termina scriptul curent
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());//returnare descriere eroare de conexiune, daca exista
}
