<?php
//incepe o sesiune
 session_start();

 //preluam tot din fisierul specificat - conectarea la baza de date
 include('../config/db.php');

 //daca se incearca intrarea directa pe pagina delProducts.php vom fi redirectionati  catre pagina de login - doar admin-ul are acces aici !!
 if(!isset($_SESSION['email']) && empty($_SESSION['email']) ){
  header('location:login.php');
 }
 
 //stergerea unui produs
 if(isset($_GET['id'])){//verificare daca variabila este setata
    $product_id = $_GET['id'];
   $sql = "DELETE FROM products WHERE product_id='$product_id'";
   $result = mysqli_query($conn, $sql);//efectuare interogare

   //trimitere la pagina cu produse actualizata , pentru a putea observa stergerea  efectuata
   header('location:products.php');


 }


?>