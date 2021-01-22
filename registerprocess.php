<?php 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php');

 //preluam tot din fisierul specificat - conectare la baza de date
include('config/db.php');
 
if(isset($_POST['submit'])){//verificare daca variabila este setata
     $email = mysqli_real_escape_string($conn, $_POST['email']);//se scapa de caracterele speciale din sir  pt a putea fi utilizate in interogarea ce urmeaza
     $password =  password_hash($_POST['password'], PASSWORD_DEFAULT); //creeaza un nou hash de parola utilizand un alg puternic fiind compatibil cu crypt()- criptarea parolei
    

    $sql = "INSERT INTO users (email, password ) VALUES ('$email', '$password' )";
    

 
  if (mysqli_query($conn, $sql)) {//efectuare interogare
    $_SESSION['customer'] = $email;
    $_SESSION['customerid'] = mysqli_insert_id($conn);//returnare id generat la ultima interogare
    header('location:index.php');
  } else {
    header('location:login.php?message=2');
    echo("Error description: " . mysqli_error($conn));//returnare descriere eroare pentru cel mai recent apel de functie(daca exista)
  }
  
}

?>