<?php 
//preluam tot din fisierul specificat - partea de conectare la baza de date
include('config/db.php');
 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php');  

//preluam tot din fisierul specificat - partea de navigation bar
include('inc/nav.php'); 

 
?>
 
 <!-- cum va arata concret pagina view-order.php -->
<div class="container text-white">
    <h2 style="text-align: center; color:#D98880;">My Account</h2>

    <section id="content">
		<div class="content-blog content-account">
			<div class="container">
				<div class="row">
				 
					<div class="col-md-12">

			<h3 style="color:#D98880;">Recent Orders</h3>
			<br>
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

                    if(isset($_GET['id'])){//verificare daca variabila este setata
                           $o_id = $_GET['id'];
                    }


 $sql_orders = "SELECT * FROM orders WHERE id='$o_id' AND userid='$c_id'";
 $result_orders = mysqli_query($conn, $sql_orders);//efectuare interogare

 $row_orders = mysqli_fetch_assoc($result_orders);//preluare rand de rezultate ca o matrice asociativa
  
				$sql = "SELECT * FROM ordersItems WHERE orderid='$o_id'";
				$result = mysqli_query($conn, $sql);//efectuare interogare
			  
				if (mysqli_num_rows($result) > 0) {//returnare numar de randuri din acest set de rezultate
			 
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


                       <a href="single.php?id=<?php echo $prodID ;?>"><?php echo $row_prod['product_name'];?></a><!-- redirectionare catre pagina cu prezentarea produsulului single.php -->
					 
						</td>
						<td>
						<?php echo $row["quantity"] ?><!-- afisare cantitate produs -->
						</td>
						<td>
						<?php echo $row["productprice"] ?><!-- afisare pret produs -->	
						</td>
						<td>
						<?php echo $row["quantity"] * $row["productprice"] ?> <!-- afisare pret total pe produs -->		
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
						<th><?php echo  $row_orders['totalprice'] ?></th> <!-- afisare pret total pe comanda -->
					</tr>
                    <tr>
					 
						<th></th>
						<th></th>
						<th>Order Status</th>
						<th><?php echo  $row_orders['orderstatus'] ?></th><!-- afisare stare comanda-->
					</tr>
                    <tr>
					 
						<th></th>
						<th></th>
						<th>Date</th> 
						<th><?php echo date('M j g:i A', strtotime($row_orders["timestamp"]));  ?></th><!-- afisare data in care s-a facut comanda-->
					</tr>
				</tfooer>
			</table>		

		 

			<div class="ma-address">
						<h3 style="color:#D98880;">My Addresses</h3>
						<p style="color:#D98880;">The following addresses will be used on the checkout page by default.</p>

			<div class="row  bg-white text-dark px-5 py-3">
				<div class="col-md-6">
								<h4>Billing Address <a href="update_address.php?id=<?php echo $c_id ?>">Edit</a></h4> <!-- se poate folosi optiunea de a edita  adresa de facturare -->
                                <?php  
                        $sql_add = "SELECT * FROM user_data  WHERE userid='$c_id'";
                        $result_add = mysqli_query($conn, $sql_add);//efectuare interogare
                      
                     $row_add = mysqli_fetch_assoc($result_add); //preluare rand de rezultate ca o matrice asociativa
                        echo $row_add['firstname'] ." ". $row_add['lastname'] . "<br>";  //afisare date de facturare 
                        echo $row_add['company'] . "<br>";
                        echo $row_add['address1'] . "<br>";
                        echo $row_add['address2'] . "<br>";
                        echo $row_add['city'] . "<br>";
                        echo $row_add['zip'] . "<br>";
                        echo $row_add['country'] . "<br>";
                        echo $row_add['mobile'] . "<br>";

                        ?>
				  </div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php');  ?>


