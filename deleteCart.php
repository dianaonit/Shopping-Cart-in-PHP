 <?php
 //incepe o sesiune
 session_start();

 if(isset($_GET['id'])){//se verifica daca variabila este setata
     $id = $_GET['id'];
     unset($_SESSION['cart'][$id]);//desactivare variabila pt sesiune
      header('location:cart.php');//trimitere catre pagina cart.php

 }

 ?>