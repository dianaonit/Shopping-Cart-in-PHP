<?php
//preluam tot din fisierul specificat - partea de header
include('inc/header.php');  
//preluam tot din fisierul specificat - conectarea la baza de date
include('config/db.php'); 
?>

<?php 
//preluam tot din fisierul specificat - partea de navigation bar
include('inc/nav.php');?>
 
 
<div class="content mt-5">
    <ul class="rig columns-4">

<?php 
    // afisare produse
   $sql = "SELECT * FROM products";
    if(isset($_GET['id'])){//se verifica ca variabila sa fie setata
       $catID = $_GET['id'];
     $sql .= " WHERE cat_id = '$catID'";
    }

   $result = mysqli_query($conn, $sql);//efectuare interogare
 
  while($row = mysqli_fetch_assoc($result)) {//preia randul de rezultate ca o matrice asociativa
    ?>          <li>
                    <a href="#"><img class="product-image" src="admin/<?php echo  $row["thumb"] ?>"></a> <!-- imagine produs -->
                    <h4><?php echo  $row["product_name"] ?></h4> <!-- nume produs -->

                    <div class="price"> <b><?php echo  $row["price"] ?>.00 $ </b></div> <!--pret produs -->
                    
                    <hr>
                    <!-- butonul de adaugare in cos -->
                    <a href='addToCart.php?id=<?php echo  $row["product_id"] ?>'  class="btn btn-default btn-xs pull-right" style ="justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 150px; border-radius: 30px;" >
                        <i class="fa fa-cart-arrow-down"></i> Add To Cart
                    </a>

                    <!-- butonul de vizualizare detalii produs -->
                    <a   href='single.php?id=<?php echo  $row["product_id"] ?>' class="btn btn-default btn-xs pull-left" style ="justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 100px; border-radius: 30px;">
                        <i class="fa fa-eye"></i> Details
                    </a>
                </li>


                <?php
                }  
                  ?>
               
          
             
            </ul>
        </div>


<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php');  ?>


