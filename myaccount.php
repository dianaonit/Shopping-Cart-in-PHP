<?php 
//preluam tot din fisierul specificat - conectarea la baza de date
include('config/db.php');
 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php');  

//preluam tot din fisierul specificat - partea de navigation bar 
include('inc/nav.php'); 

?>
 
 
 <!-- cum va arata concret pagina de myaccount.php -->  
 
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
						<th>Total Price</th>
						<th>Order Status</th>
						<th>Paymentmode</th>
						<th>Date and Time</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$c_id = $_SESSION['customerid'];

				$sql = "SELECT * FROM orders WHERE userid='$c_id'";
				$result = mysqli_query($conn, $sql);//efectuare interogare
			  
				if (mysqli_num_rows($result) > 0) {//returnare numar de randuri
				 // output data of each row
				 while($row = mysqli_fetch_assoc($result)) {//preluare rand rzultate ca o matrice asociativa
 			?>
					<tr>
						<td>
						  <?php echo $row["totalprice"] ?>
						</td>
						<td>
						  <?php echo $row["orderstatus"] ?>
						</td>
						<td>
						  <?php echo $row["paymentmode"] ?>		
						</td>
						<td>
						

						<?php echo date('M j g:i A', strtotime($row["timestamp"]));  ?>	<!-- formatare data si ora locala - returnare sirul de date formatat -->
						</td>
						<td>
							<!--  actiunile  ce sunt disponibile pentru Recent Orders-->
							<a href="view-order.php?id=<?php echo $row["id"] ?>">View</a> 
							<?php if($row["orderstatus"] != 'Cancelled'){ ?>
								|  <a href="cancel-order.php?id=<?php echo $row["id"] ?>">Cancel</a> 
							<?php }?>
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

		 

			<div class="ma-address">
						<h3 style="color:#D98880;">My Addresses</h3>
						

						<div class="row  bg-white text-dark px-5 py-3">
				<div class="col-md-6">
								<h4>Billing Address <a href="update_address.php?id=<?php echo $c_id ?>">Edit</a></h4> <!-- actiune se editare a adresei de facturare  -->
                                <?php  
                        $sql_add = "SELECT * FROM user_data  WHERE userid='$c_id'";
                        $result_add = mysqli_query($conn, $sql_add);//efectuare interogare
                      
                     $row_add = mysqli_fetch_assoc($result_add); //preluare rand de rezultate ca o matrice asociativa
                        echo $row_add['firstname'] ." ". $row_add['lastname'] . "<br>";
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
	</section>
	
 
</div>



<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php');  ?>


