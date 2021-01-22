<?php 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php');

//preluam tot din fisierul specificat - partea de hconectare la baza de date 
include('config/db.php');
?>


<?php 
//preluam tot din fisierul specificat - partea de navigation bar
include('inc/nav.php'); 

//setare variabila a sesiunii
$cart =  $_SESSION['cart'];
?>
 
 <!-- cum va arata concret pagina cart.php -->
<div class="container">
    <h2 class='text-center text-white'>Cart</h2>

   <table class="table table-bordered bg-white">
       <tr>
           <th>Image</th>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Total</th>
           <th>Action</th>
       </tr>

       <?php
       $total = 0;
       foreach($cart as $key => $value){
        
        $sql = "SELECT * FROM products where product_id = $key";
        $result = mysqli_query($conn, $sql);//efectuare interogare

        $row = mysqli_fetch_assoc($result)//preluare rand de rezultate ca o matrice asociativa
        ?>


            <tr>
           <td><img src="admin/<?php echo $row['thumb']?> " alt=""></td>
           <td><a href="single.php?id=<?php echo $row['product_id']?>"><?php echo $row['product_name']?></a></td>
           <td><?php echo $row['price']?> </td>
           <td><?php echo $value['quantity']?></td>
           <td><?php echo $row['price'] * $value['quantity'] ?> </td>
            <td><a href='deleteCart.php?id=<?php echo $key; ?>'>Remove</a></td> <!-- actiune de stergere din cos un produs -->
            </tr>

        <?php

            $total = $total +  ($row['price'] * $value['quantity']);
    }
    
    ?>
      
   </table>

   <div class="text-right">
    

    <a class="btn" href='checkout.php' style ="justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 100px; border-radius: 30px;">Checkout</a>
</div>
<div class="card">
<div class="card-header">Total</div>
<div class="card-body">
Total Amount: <?php echo $total; ?>.00 $
</div>
</div>

</div>



<?php
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php');  ?>


