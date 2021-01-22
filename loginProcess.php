<?php 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php');

//incepe o sesiune
session_start();

//preluam tot din fisierul specificat - conectare la baza de date
include('config/db.php');
 

if(isset($_POST['submit'])){//verifica daca variabila este setata
     $email = mysqli_real_escape_string($conn, $_POST['email']);//se scapa de caracterele speciale din sir pentru a putea folosite in interogare
     $password = $_POST['password'];
    
$sql = "SELECT * FROM users WHERE email='$email' ";
$result = mysqli_query($conn, $sql);//efectuare interogare
$row = mysqli_fetch_assoc($result);//preia randul de rezultate ca o matrice asoiativa
 $dbStoredPASSWORD = $row['password'];

if (password_verify ($password, $dbStoredPASSWORD)) {// creează un nou hash de parolă utilizând un algoritm puternic de hash unidirecționa- hashurile de parole create de crypt () pot fi utilizate cu password_hash ().
     $_SESSION['customerid'] = $row['id'];
     header('location:index.php');
  } else {
    header('location:login.php?message=1');

  }
  
}

?>