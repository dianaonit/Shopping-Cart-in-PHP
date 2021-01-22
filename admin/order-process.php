<?php
//activare buffer de iesire 
  ob_start();
?> 

<?php  
//preluam tot din fisierul specificat - partea de header
include('inc/header.php'); 

//preluam tot din fisierul specificat - partea de navigation bar 
include('inc/nav.php');  

//preluam tot din fisierul specificat - conectarea la baza de date
include('../config/db.php');

 
 //modificare status comanda
if(isset($_POST['submit'])){//verificare daca variabila este setata
	$orderid = $_POST['orderid'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];; 
    $insertCancel = "INSERT INTO ordersTracking (orderid, status, reason )VALUES ('$orderid', '$status', '$reason')";  
 
	if(mysqli_query($conn, $insertCancel)){//
        $up_sql = "UPDATE orders SET orderstatus='$status'  WHERE id=$orderid";
		mysqli_query($conn, $up_sql);//efectuare interogare 
		//trimitere catre pagina orders.php pentru a putea vizualiza modificarea facuta
        header('location:orders.php');
    }
}
 
?>


<!-- cum va arata concret pagina  order-process.php -->

<div class="container text-white">

<?php
 $total = 0;
?>

    <section id="content">
		<div class="content-blog">
					<div class="page_header text-center  py-5">
						<h2 style="background-color:#D98880;">Process Order</h2>
						 
					</div>
<form method='post'>
 
<div class="container ">
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
                    <table class="cart-table account-table table table-bordered bg-white text-dark">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Total Price</th>
						<th>Status</th>
						<th>Payment Mode</th>
						
					</tr>
				</thead>
				<tbody>
				<?php

              if(isset($_GET['id'])){//verificar edaca variabila este setata
                     $o_id = $_GET['id'];
              }
                $sql = "SELECT * FROM orders WHERE id='$o_id'";
				$result = mysqli_query($conn, $sql);//efectuare interogare 
			  
				if (mysqli_num_rows($result) > 0) {//returnare numar randuri din setul de rezultate
			        //iesire date pentru fiecare rand
				 while($row = mysqli_fetch_assoc($result)) {
                
 			?>
					<tr>
						<td>
                        <?php 
                        $sql_proID = "SELECT * FROM ordersItems WHERE orderid='$o_id'";
                        $result_proID = mysqli_query($conn, $sql_proID);
                        $row_prodID = mysqli_fetch_assoc($result_proID);
                        $p_id =  $row_prodID['productid'];

                        $sql_ProName = "SELECT * FROM products WHERE product_id='$p_id'";
                        $result_ProName = mysqli_query($conn, $sql_ProName);
                        $row_ProName = mysqli_fetch_assoc($result_ProName);
                        echo  $row_ProName['product_name']; //afisare nume produs
                        ?>
						</td>

						<td>
						<?php echo $row["totalprice"] ?><!-- afisare pret total comanda-->
						</td>

						<td>
						<?php echo $row["orderstatus"] ?><!-- afisare stare comanda -->
						</td>

						<td>
						<?php echo $row["paymentmode"]  ?> <!-- afisare metoda de plata -->		
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
						<div class="space30">
						</div>
					 
						 
                        <div class="form-group">
                               <label for="sel1">Change Status:</label>
                                       <select class="form-control" name="status"> <!-- selectare optiune schimbare stare comanda  -->
                                           <option value='In Progress'>In Progress</option>
                                           <option value='Dispatched'>Dispatched</option>
										   <option value='Delivered'>Delivered</option>
										   <option value='Cancelled'>Cancelled</option>
                                       </select>
                        </div>
						 
							<div class="clearfix space20"></div>
							<label>Reason</label>
 						    <textarea class="form-control" name='reason' id="" cols="30" rows="10" placeholder ="Type Reason"></textarea> <!--  inregistrare motiv schimbare  stare comanda-->
					 
					 
					    </div>
				</div>
			
			</div>
		
        </div>		
        
        <div class="row"style="margin-top:20px;">
            <div class="col-md-12 text-center">
                <input type="hidden" name='orderid' value='<?php echo $_GET['id'] ?>'>
                <input type='submit' name='submit' value='Change Status' class="btn" style="background-color:#D98880; border: none; color : #FFFFFF"><!-- modificare stare comanda -->
            </div>
        </div>
		
		</div>
	</section>
</div>

</form>


<?php 
//preluam tot din fisierul specificat - partea de footer 
include('inc/footer.php');  ?>



