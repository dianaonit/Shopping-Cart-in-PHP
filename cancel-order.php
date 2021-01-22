<?php  
//preluam tot din fisierul specificat - partea de header
include('inc/header.php');

//preluam tot din fisierul specificat - partea de navigation bar
include('inc/nav.php');  
 
//preluam tot din fisierul specificat - partea de hconectare la baza de date 
include('config/db.php'); 

//nu se poate accesa pagina de cancel-order.php daca nu suntem logati 
if(!isset($_SESSION['customer']) && empty($_SESSION['customer']) ){
 header('location:login.php');
}

 
if(!isset($_SESSION['customerid'])){
	echo '<script>window.location.href = "login.php";</script>';

}


$message  = '';
$_POST['agree'] = 'false';

if(isset($_POST['submit'])){//verificare daca variabila este setata
	 
	$orderid = $_POST['orderid'];
    $reason = $_POST['reason'];
    $status = 'cancelled';

 
    $insertCancel = "INSERT INTO ordersTracking (orderid, status, reason )VALUES ('$orderid', '$status', '$reason')";  

	if(mysqli_query($conn, $insertCancel)){//efectuare interogare
    $up_sql = "UPDATE orders SET orderstatus='Cancelled'  WHERE id=$orderid";
	mysqli_query($conn, $up_sql);//efectuare interogare
	//trimitere catre pagina myaccount.php
    header('location:myaccount.php');

    }
}
 
  $cid =$_SESSION['customerid'];

  $sql = "SELECT * FROM user_data where userid = $cid";
  $result = mysqli_query($conn, $sql);//efectuare interogare
  $row = mysqli_fetch_assoc($result);//preluare rand de rezultate ca o matrice asociativa

  ?>

 <div class="container text-white">

 <?php

 if(isset($_SESSION['cart'])){
	$total = 0;
	foreach($cart as $key => $value){
	 
	 $sql_cart = "SELECT * FROM products where product_id = $key";
	 $result_cart = mysqli_query($conn, $sql_cart);//efectuare interogare 
	 $row_cart = mysqli_fetch_assoc($result_cart);//preluare rand de rezultate ca o matrice asociativa
	 $total = $total +  ($row_cart['price'] * $value['quantity']);
}
}

 ?>

    <section id="content">
		<div class="content-blog">
					<div class="page_header text-center  py-5">
						<h2 style="color:#D98880;">Cancel Order</h2>
						 
					</div>
<form method='post'>
<?php echo $message ?>
<div class="container ">
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
                    <table class="cart-table account-table table table-bordered bg-white text-dark">
				<thead>
					<tr>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total Price</th>
						
					</tr>
				</thead>
				<tbody>
				<?php
				$c_id = $_SESSION['customerid'];

          if(isset($_GET['id'])){
                 $o_id = $_GET['id'];
            }


 $sql_orders = "SELECT * FROM orders WHERE id='$o_id' AND userid='$c_id'";
 $result_orders = mysqli_query($conn, $sql_orders);//efectuare interogare

 $row_orders = mysqli_fetch_assoc($result_orders);//preluare rand de rezultate ca o matrice asociativa
  
				$sql = "SELECT * FROM ordersItems WHERE orderid='$o_id'";
				$result = mysqli_query($conn, $sql);//efectuare interogare
			  
				if (mysqli_num_rows($result) > 0) {//returnare numar de randuri  din setul de rezultate
			 
				 while($row = mysqli_fetch_assoc($result)) {//preluare rand de rezultate ca o matrice asociativa
  
                  $prodID = $row["productid"] 
 			?>
					<tr>
						<td>

                        <?php 
                        
                        $sql_product = "SELECT * FROM products  WHERE product_id='$prodID'";
                        $result_prod = mysqli_query($conn, $sql_product);//efectuare interogare
                      
                        $row_prod = mysqli_fetch_assoc($result_prod);//preluare rand de rezultate ca o matrice asociativa
                    
                        ?>


                        <a href="single.php?id=<?php echo $prodID ;?>"><?php echo $row_prod['product_name'];?></a>
					 
						</td>
						<td>
						<?php echo $row["quantity"] ?>
						</td>
						<td>
						<?php echo $row["productprice"] ?>		
						</td>
						<td>
						<?php echo $row["quantity"] * $row["productprice"] ?>		
						</td>
					 
					</tr>
				 
			
			<?php
				}
			   } else {
				 echo "0 results";
			   }
			 
			 
			 ?>
				
				</tbody>
                <tfooer>
					<tr>
						 
						<th></th>
						<th></th>
						<th>Total Price</th>
						<th><?php echo  $row_orders['totalprice'] ?></th>
					</tr>
                    <tr>
					 
						<th></th>
						<th></th>
						<th>Order Status</th>
						<th><?php echo  $row_orders['orderstatus'] ?></th>
					</tr>
                    <tr>
					 
						<th></th>
						<th></th>
						<th>Date</th>
						<th><?php echo  $row_orders['timestamp'] ?></th>
					</tr>
				</tfooer>
			</table>
						<div class="space30"></div>
					 
							<div class="clearfix space20"></div>
							<label style="color:#D98880;">Reason</label>
 						 <textarea class="form-control" name='reason' id="" cols="30" rows="10"></textarea>
					 
					</div>
				</div>
				
			</div>
        </div>		
        
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="hidden" name='orderid' value='<?php echo $_GET['id'] ?>'>
                <input type='submit' name='submit' value='Cancel Order' class="btn" style ="justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 150px; border-radius: 30px;">
            </div>
        </div>
		
		</div>
	</section>
</div>

</form>



<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php');  ?>


