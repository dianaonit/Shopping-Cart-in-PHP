<!-- pagina pentru fiecare produs -->

<?php 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php');  ?>

<?php 
//preluam tot din fisierul specificat - partea de navigation bar 
include('inc/nav.php');  

//preluam tot din fisierul specificat - conectare la baza de date
include('config/db.php');

 //afisare produs pe pagina 
 if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products  WHERE product_id='$product_id'";
    $result = mysqli_query($conn, $sql);//efectuare interogare
 
    $row = mysqli_fetch_assoc($result);//preluare rand de rezultate ca o matrice asociativa

    $product_name  = $row['product_name'];
    $cat_id  = $row['cat_id']; 
    $price  = $row['price'];
    $product_description  = $row['product_description'];
    $thumb  = $row['thumb'];
 }

?>
 
 
 <!-- cum va arata concret pagina single.php -->
<div class="container">

    <div class="row text-white">
        <div class="col-md-6 ">
            <img src="admin/<?php echo $thumb ?>" alt="" class='img-fluid' style='height:500px;width:500px;'> <!-- afisare poza -->
        </div>
        <div class="col-md-6 pt-5">
        <h3 style ="color:#302e2e;"><b><?php echo $product_name ?></b></h3> <!-- afisare nume produs -->
        <h2 style ="color:#302e2e;"><b><?php echo  $price ?>.00 $</b></h2> <!-- afisare pret produs -->
        <p> </p>
                  
       
<div class="row">
    <div class="col-md-2" style ="color:#302e2e;">
        Quantity:
    </div>
    <div class="col-md-2">
    <form action='addToCart.php'>  
    <input type="hidden" name='id' value='<?php echo  $product_id ?>'>
        <input type="number" class='form-control' name='quantity' value='1'> 
       
    </div>
   
</div>

<div class="row ">
    <div class="col-md-12 category" style ="color:#302e2e;">
      <p style ="color:#302e2e;font-weight: bold;">Details:</p>   
      <p> <?php echo $product_description ?></p> <!-- afisare descriere produs --> 
    </div>
    

</div>

<div class="row mt-4">
    <div class="col-md-4">
    <button  type='submit' class="btn btn-default btn-xs pull-right" style ="justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 150px; border-radius: 30px;" >                 
    <i class="fa fa-cart-arrow-down"></i> Add To Cart
    </button>

</div>
</div>
</form>


</div>
</div>
</div>

<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php');  ?>



