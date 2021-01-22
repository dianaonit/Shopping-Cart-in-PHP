<?php
//incepe o sesiune
session_start();
//preluam tot din fisierul specificat - conectarea la baza de date
include('../config/db.php');

//daca se incearca intrarea directa pe pagina products.php vom fi redirectionati  catre pagina de login- doar admin-ul are acces aici 
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

<!-- cum va arata concret pagina  products.php -->
<div class="container" style="margin-top:45px;">

<div class="card">
            <div class="card-header">
                All Products
            </div>
<div class="card-body">
<section id="content mt-5">
	<div class="content-blog  bg-white">
		<div class="container">
			<table class="table table-striped">
				<thead>
					<tr> 
						<th>Product Name</th>
						<th>Category</th>
						<th>Picture</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

                <?php
                //se selecteaza tot din tabelul Products
                   $sql = "SELECT * FROM products";
                   $result = mysqli_query($conn, $sql);//efectuare interogare

                     if (mysqli_num_rows($result) > 0) {//returnare numar randuri din setul de rezultat e
                       //iesire date pentru fiecare rand
                       while($row = mysqli_fetch_assoc($result)) { // preluare rand de rezultate ca o matrice asociativa

                ?>
      
        <tr>
            <td><?php echo $row["product_name"] ?></td> <!-- afisare nume produs-->
            <td><?php echo $row["cat_id"] ?></td> <!-- afisare categorie  din care face parte produsul-->
            <td><?php if(isset($row["thumb"])){echo 'Yes'; }else{ echo 'No'; }  ?></td> <!-- daca este incarcata poza sau nu -->
            <td>
            <!-- afisare actiuni de editare si stergere pentru produse -->
              <a href='editProducts.php?id=<?php echo $row["product_id"] ?>'>Edit</a> 
            | <a href='delProducts.php?id=<?php echo $row["product_id"] ?>'>Delete</a></td>
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