<?php
//incepe o sesiune
 session_start();

 //preluam tot din fisierul specificat - conectarea la baza de date
 include('../config/db.php');

//daca se incearca intrarea directa pe pagina delCategories.php vom fi redirectionati  catre pagina de login- doar admin-ul are acces aici 
 if(!isset($_SESSION['email']) && empty($_SESSION['email']) ){
  header('location:login.php');
 }
 
 
//stergerea unei categorii de produse pe baza id-ului categoriei 
if(isset($_GET['id'])){//verificare daca variabila este setata
    $catid = $_GET['id'];
   $sql = "DELETE FROM Category WHERE cat_id='$catid'";
   $result = mysqli_query($conn, $sql);//efectuare interogare
   //dupa stergere se face trimiterea la pagina categories.php unde se poate vizualiza stergerea facuta 
   header('location:categories.php');
}


?>