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


<!-- cum va arata concret pagina  orders.php -->

<div class="container" style="margin-top:45px;">

<div class="card">
   <div class="card-header">
     All Orders
   </div>
<div class="card-body">
<section id="content mt-5">
	<div class="content-blog  bg-white">
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr> 
						<th>Customer Name</th>
						<th>Total Price</th>
						<th>Order Status</th>
						<th>Payment Mode </th>
                        <th>Order Placed On</th>
                        <th>Operation</th> 
					</tr>
				</thead>
				<tbody>

                <?php

      $sql = "SELECT orders.totalprice, orders.orderstatus, orders.paymentmode, orders.timestamp, orders.id, user_data.firstname, user_data.lastname FROM orders JOIN user_data ON orders.userid=user_data.userid ORDER BY `orders`.`id` DESC    ";
      $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        //iesire date pentru fiecare rand
        while($row = mysqli_fetch_assoc($result)) {

            ?>
      
        <tr>
            <td><?php echo $row["firstname"] ." ".$row["lastname"] ?></td> <!-- concatenare firstname cu lastname  -->
            <td><?php echo $row["totalprice"] ?></td><!-- afisare pret final comanda -->
            <td><?php echo $row["orderstatus"] ?></td><!-- afisare stare comanda -->
            <td><?php echo $row["paymentmode"] ?></td><!-- afisare metoda de plata  -->
            <td><?php echo date('M j g:i A', strtotime($row["timestamp"]));  ?>		</td> <!-- afisare data la care s-a facut comanda  -->
            <!-- la partea de Operation -->
            <td><a href='order-process.php?id=<?php echo $row["id"] ?>'>Change Status</a> <!-- optiunea de a schimba status-ul/starea comenzii - redirectionare catre order-process.php -->
            
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
	</div>

</section>
</div>
</div>


</div>

<?php
//preluam tot din fisierul specificat - partea de footer 
include('inc/footer.php') ?>