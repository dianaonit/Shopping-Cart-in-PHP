<?php
//incepe o sesiune
session_start();
//preluam tot din fisierul specificat - conectarea la baza de date
include('../config/db.php');

//daca se incearca intrarea directa pe pagina categories.php vom fi redirectionati  catre pagina de login- doar admin-ul are acces aici 
if(!isset($_SESSION['email']) && empty($_SESSION['email']) ){
 header('location:login.php');
}

?>

<?php 
//preluam tot din fisierul specificat - partea de header  
include('inc/header.php') ?>


<?php
//preluam tot din fisierul specificat  -partea de navigation bar 
include('inc/nav.php') ?>

<!-- cum va arata concret pagina  index.php -->
<div> 
   
<p style="text-align: center; color:#D98880; font-size:40px; margin-top: 60px;">Hello Admin! Here you can make changes to the table of products, categories and orders. Good luck with that!<p>

</div>


<?php 
//preluam tot din fisierul specificat- partea de footer 
include('inc/footer.php') ?>