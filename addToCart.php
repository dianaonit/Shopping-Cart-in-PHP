<?php
//incepe o sesiune
 session_start();

 
if(isset($_GET['id'])){//verificare daca variabila este setata

    if(isset($_GET['quantity'])){//verificare daca variabila este setata
        $quantity = $_GET['quantity'];
    }else{
        $quantity = 1;
    }
     $id = $_GET['id'];

   $_SESSION['cart'][$id] = array('quantity' => $quantity);//creare array
   //trimitere catre pagina cart.php
    header('location:cart.php');

   echo '<pre>';
   print_r($_SESSION['cart']);//tiparire informatii despre variabila intr-un mod mai usor de citit
   echo '</pre>';
 }
 
?>