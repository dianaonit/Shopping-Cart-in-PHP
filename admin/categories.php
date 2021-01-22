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
//preluam tot din fisierul specificat - partea de navigation bar 
 include('inc/nav.php') ?>

<

<div class="container pt-5">
<table class='table table-bordered bg-white'>
     <!--grupare continut in tabel -fir -->
    <thead>
        <tr>
            <td>Name</td>
            <td>Action</td>
        </tr>
    </thead>

    <?php
    //se selecteaza tot din tabelul Category 
    $sql = "SELECT * FROM Category";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
       //iesire date pentru fiecare rand in parte
        while($row = mysqli_fetch_assoc($result)) {

            ?>
        
        <tbody>
        <tr>
            <td><?php echo $row["cat_name"] ?></td><!-- afisare categorii -->
            <td>
            <!-- afisare actiuni de editare si stergere pentru categorii -->
               <a href='editCategory.php?id=<?php echo $row["cat_id"] ?>'>Edit</a> 
               <a href='delCategory.php?id=<?php echo $row["cat_id"] ?>'>Delete</a>
            </td>
        </tr>

        
        <?php
        }
      } else {
        echo "0 results";
      }


?>
       </tbody>
    
</table>
</div>




<?php 
//preluam tot din fisierul specificat - partea de footer 
include('inc/footer.php') ?>