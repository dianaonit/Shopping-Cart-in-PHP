<?php
//incepe o sesiune
session_start();

//preluam tot din fisierul specificat - conectarea la baza de date
include('../config/db.php');

//daca se incearca intrarea directa pe pagina categories.php vom fi redirectionati  catre pagina de login- doar admin-ul are acces aici 
if(!isset($_SESSION['email']) && empty($_SESSION['email']) ){
   header('location:login.php');
}

//adaugare categorie noua
if(isset($_POST['submit'])){//verificare daca variabila este setata
    $catName = $_POST['catName'];
     //inserare nume categorie
    $sql = "INSERT INTO Category (cat_name) VALUES ('$catName')";

     if (mysqli_query($conn, $sql)) {//efectuare interogare
        echo "New record created successfully!";
        // daca totul a fost ok se face trimitere catre pagina Categories.php
        header('location:categories.php');
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);//returnare descriere eroare pentru cel mai recent apel de functie (daca exista)
      }

}
?> 


<?php 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php') ?>

<?php 
//preluam tot din fisierul specificat - partea de navigation bar 
include('inc/nav.php') ?>

 <!-- cum va arata concret pagina  addCategory.php -->
<div class="container">

<div class="card" style="margin-top:45px;">
    <div class="card-header">
        Add Category
    </div>
    <div class="card-body">

    <form action="addCategory.php" method='post'>
             <div class="form-group">
            <label for="catName"> Name:</label>
            <input type="text" class="form-control" id="catName" name='catName'> <!-- nume categorie -->
            </div> 
            <button type="submit" name='submit' class="btn btn-primary" style="background-color:#D98880; border: none;">Submit</button>
    </form>

    </div>
</div>



</div>


<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php') ?>