<?php
//incepe o sesiune
session_start();
//preluam tot din fisierul specificat - conectarea la baza de date
include('../config/db.php');

//daca se incearca intrarea directa pe pagina editCategories.php vom fi redirectionati  catre pagina de login- doar admin-ul are acces aici 
if(!isset($_SESSION['email']) && empty($_SESSION['email']) ){
 header('location:login.php');
}

//se ia id-ul de la categoria dorita 
  if(isset($_GET['id'])){//verificare daca variabila este setata
    $catid = $_GET['id'];
    $sql = "SELECT * FROM Category where cat_id = '$catid'";
    $result = mysqli_query($conn, $sql);//efectuare interogare
    $row = mysqli_fetch_assoc($result);//preluare rand de rezultate ca o matrice asociativa

 }

//se fac schimbarile dorite apoi se salveaza modificarea 
 if(isset($_POST['submit'])){//verificare daca variabila este setata
     $hiddenID = $_POST['hiddenID'];
     $catName = $_POST['catName'];

     //modificarea efectiva a unei categori pe baza id-ului categoriei
     $sql = "UPDATE Category SET cat_name='$catName' WHERE cat_id='$hiddenID'";
 
    if ($conn->query($sql) === TRUE) {//efectuare interogare
        echo "Record updated successfully!";
        //dupa modificare se face trimiterea la pagina categories.php unde se poate vizualiza modificarea facuta 
        header('location:categories.php');
      } else {
        //in cazul unei erori la update/conectare  apare mesajul 
        echo "Error updating record: " . $conn->error;
      }

 }

?> 


<?php 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php') ?>

<?php 
//preluam tot din fisierul specificat - partea de navigation bar 
include('inc/nav.php') ?>


<!-- structura efectiva a paginii editCategory.php-->
<div class="container" style="margin-top:45px;">

 <div class="card">

    <div class="card-header">
        Edit Category
    </div>

    <div class="card-body">

          <form action="editCategory.php" method='post'>
          <div class="form-group">
            <label for="catName"> Name:</label>
            <input type="text" class="form-control" id="catName" name='catName'value='<?php echo  $row['cat_name'] ?>'> <!-- afisare nume categorie -->
            <input type="hidden" value='<?php echo $catid ?>' name='hiddenID'>
    
          </div> 
            <button type="submit" name='submit' class="btn btn-primary" style="background-color:#D98880; border: none; color : #FFFFFF">Submit</button>
          </form>

    </div>

  </div>

</div>



<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php') ?>