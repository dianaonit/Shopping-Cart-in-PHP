<?php
//incepe o sesiune
session_start();

//preluam tot din fisierul specificat - conectarea la baza de date
include('../config/db.php');

//daca se incearca intrarea directa pe pagina editProducts.php vom fi redirectionati  catre pagina de login- doar admin-ul are acces aici 
if(!isset($_SESSION['email']) && empty($_SESSION['email']) ){
 header('location:login.php');
}



//actualizare interogare 
if(isset($_POST['submit'])){//verificare daca variabila este setata
    $productname = $_POST['productname'];
    $productdescription = $_POST['productdescription'];
    $productcategory = $_POST['productcategory'];
    $productprice = $_POST['productprice']; 
	$product_id = $_POST['hiddenID']; //nu este nevoie sa vedem si  id-ul produsului (hidden)


		if(isset($_FILES) & !empty($_FILES)){
			$name = $_FILES['productimage']['name'];
			$size = $_FILES['productimage']['size'];
			$type = $_FILES['productimage']['type'];
			$tmp_name = $_FILES['productimage']['tmp_name']; 
			$max_size = 10000000;
			$extension = substr($name, strpos($name, '.') + 1); //returnare o parte din string + gasire pozitie a primei aparitii a string-ului in alt string
			if(isset($name) && !empty($name)){
				if(($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $size<=$max_size){
					$location = "uploads/";//locatia unde se afla pozele incarcate de admin 
					$filePath = $location.$name;
					if(move_uploaded_file($tmp_name, $filePath)){//se muta fisierul incarcat intr-o destinatie noua
						  
						//modificarea efectiva a unui produs
			        $sql2 = "UPDATE products SET product_name='$productname', product_description='$productdescription', cat_id='$productcategory', price='$productprice', thumb='$filePath'  WHERE product_id='$product_id'";
                          
						$res = mysqli_query($conn, $sql2);//efectuare interogare
						if($res){
							$message = 'Saved Successfully with image !';
						}else{
                            $message = "Failed to Create Product.Try Again!";
                            echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
						}
					}else{
						$message = "Failed to Upload File !";
					}
				}else{
					$message = "Only JPG files are allowed here!";
				}
			}else{
				$message = "Please Select a File !";
			}
		} 
		
			$sql_update = "UPDATE products SET product_name='$productname', product_description='$productdescription', cat_id='$productcategory', price='$productprice' WHERE product_id='$product_id'";
		
			//salvarea pozei cu produsul 
		 if (mysqli_query($conn, $sql_update)) {//efectuare interogare
		   
		     $message = 'Saved Successfully';
		} 
		else {
		         echo "Error: " . $sql_update . "<br>" . mysqli_error($conn);
		     }

}

//afisare detalii pentru produsul cu un anumit id din tabelul produse 
if(isset($_GET['id'])){//verificare daca variabila este setata
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products  WHERE product_id='$product_id'";
	$result = mysqli_query($conn, $sql);//efectuare interogare 
    $row = mysqli_fetch_assoc($result);//preluare rand de rezultate ca o matrice asociativa

}

?>


<?php 
//preluam tot din fisierul specificat - partea de header
include('inc/header.php') ?>

<?php 
//preluam tot din fisierul specificat - partea de navigation bar 
include('inc/nav.php') ?>


<!-- structura efectiva a paginii editProducts.php-->
<div class="container" style="margin-top:45px;">

<div class="card">
     <div class="card-header">
      Edit Products
    </div>
<div class="card-body">
<section id="content ">
	<div class="content-blog bg-white py-3">
		<div class="container"> 
        		<form method="post" enctype="multipart/form-data">
				<input type="hidden" name='hiddenID' value='<?php echo $product_id?>'><!-- id produs care e hidden deoarece nu dorim sa incarcam pagina cu detalii care nu il intereseaza deoarece id-ul se poate observa in baza de dare -->
			  <div class="form-group">
			    <label for="Productname">Product Name</label>
			    <input type="text" class="form-control" value='<?php echo $row['product_name']; ?>' name="productname" id="Productname" placeholder="Product Name"><!-- afisare nume produs -->
			  </div>
			  <div class="form-group">
			    <label for="productdescription">Product Description</label>
			    <textarea class="form-control" name="productdescription" rows="3"> <?php echo $row['product_description']; ?> </textarea><!-- afisare descriere produs -->
			  </div>

			  <div class="form-group">
			    <label for="productcategory">Product Category</label>
			    <select class="form-control" id="productcategory" name="productcategory"><!-- afisare categorie produs -->
				 
				 
				  <?php
				  //pentru afisarea categoriilor-optiunile sunt luate din tabelul Category
                    $sql2 = "SELECT * FROM Category";
                    $result2 = mysqli_query($conn, $sql2);//efectuare interogare
                       //iesire date pentru fiecare rand
                      while($row2 = mysqli_fetch_assoc($result2)) {
              
                 ?> 
				 <option value="<?php echo $row2["cat_id"] ?>" 
				 <?php
				 
					 if($row2["cat_id"] == $row['cat_id'])
					 { echo 'Selected !';

				             }else{
					              echo '...';
				                }
				   ?>>
				   <?php echo  $row2["cat_name"] ?>

				   </option> 
                      <?php
                      }
                  
                  ?>
				 
				</select>
			  </div>
			  

			  <div class="form-group">
			    <label for="productprice">Product Price</label>
			    <input type="text" class="form-control" value='<?php echo $row['price']; ?>'  name="productprice" id="productprice" placeholder="Product Price"> <!-- afisare pret produs -->
			  </div>
               
			
			  <?php  
			  //daca exista o poza incarcata se poate face stergerea acesteia 
			  if(isset($row['thumb']) && !empty($row['thumb'])){ ?>
	             <img src="<?php echo $row['thumb']; ?>" alt="" height='100' width='100'><br>

	             <a href="delproduImg.php?id=<?php echo $row['product_id'];?>">Delete Image</a><br><!-- optiune de stergere imagine -pagina delproduImg.php -->

				  <?php
			  }else{

                 ?>
        <div class="form-group">
			    <label for="productimage">Product Image</label>
			    <input type="file" name="productimage" id="productimage"> <!-- afisare poza produs -->
			    <p class="help-block">Only jpg/png are allowed here !</p>
			  </div>

				  <?php
			  } ?>
			
			  <button type="submit" name='submit' class="btn btn-default" style="background-color:#D98880; border: none; color : #FFFFFF">Submit</button>
			</form>
			
		</div>
	</div>

</section>
</div>
</div>

</div>


<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php') ?>