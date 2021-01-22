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
include('inc/nav.php') ;

if(isset($_POST['submit'])){//verificare daca variabila este setata
    $productname = $_POST['productname'];
    $productdescription = $_POST['productdescription'];
    $productcategory = $_POST['productcategory'];
    $productprice = $_POST['productprice']; 

    
		if(isset($_FILES) & !empty($_FILES)){
			$name = $_FILES['productimage']['name'];
			$size = $_FILES['productimage']['size'];
			$type = $_FILES['productimage']['type'];
			$tmp_name = $_FILES['productimage']['tmp_name'];

			$max_size = 10000000;
			$extension = substr($name, strpos($name, '.') + 1);//returnare o parte din string - gasire pozitie prima aparitie a unui alt sir in respectivul sir

			if(isset($name) && !empty($name)){
				if(($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $size<=$max_size){//extensii ce pot fi folosite pentru imagini
					$location = "uploads/";
					if(move_uploaded_file($tmp_name, $location.$name)){//mutare fisier incarcat in destinatie noua 
						
						$sql2 = "INSERT INTO products (product_name, cat_id, price, product_description, thumb) VALUES ('$productname', '$productcategory', '$productprice', '$productdescription','$location$name')";
						$res = mysqli_query($conn, $sql2);//efectuare interogare
						if($res){
							$message = 'Saved Successfully with image !';
						}else{
                            $message = "Failed to Create Product !";
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
		}else{
    $sql = "INSERT INTO products (product_name, cat_id, price, product_description)     VALUES ('$productname', '$productcategory', '$productprice', '$productdescription' )";

if (mysqli_query($conn, $sql)) {//efectuare interogare 
   
$message = 'Saved Successfully !';
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}

}

?>

 <!-- cum va arata concret pagina  addProducts.php -->
<div class="container">
<div class="card" style="margin-top:45px;">
    <div class="card-header">
       Add Products
    </div>
<div class="card-body">
<section id="content ">
	<div class="content-blog bg-white py-3">
		<div class="container"> 
        <?php
        if(isset($message)){//verificare daca variabila este setata
            ?>
    <div class="alert alert-success"><?php echo $message ?></div>
        <?php
        }
        ?>
        		<form method="post" enctype="multipart/form-data" action='addProducts.php'>
			  <div class="form-group">
			    <label for="Productname">Product Name</label>
			    <input type="text" class="form-control" name="productname" id="Productname" placeholder="Product Name"><!-- nume produs -->
			  </div>
			  <div class="form-group">
			    <label for="productdescription">Product Description</label>
			    <textarea class="form-control" name="productdescription" rows="3" placeholder="Type Description"></textarea><!-- descriere produs -->
			  </div>

			  <div class="form-group">
			    <label for="productcategory">Product Category</label>
			    <select class="form-control" id="productcategory" name="productcategory">
				  <option value="" selected disabled>SELECT CATEGORY</option> <!-- selectare categorie din care face parte produsul -->

                  <?php
                  //pentru afisarea categoriilor-optiunile sunt luate din tabelul Category
                  $sql = "SELECT * FROM Category";
                  $result = mysqli_query($conn, $sql);//efectuare interogare
                         //iesire date pentru fiecare rand
                      while($row = mysqli_fetch_assoc($result)) {?> //preia randul de date ca o matrice asociativa

                    <option value="<?php echo $row["cat_id"] ?>"><?php echo  $row["cat_name"] ?></option> <!-- la optiuni apar numele categoriei , fara id-ul acestora (hidden)-->
                      <?php
                      }
                  
                  ?>
				</select>
			  </div>
			  <div class="form-group">
			    <label for="productprice">Product Price</label>
			    <input type="text" class="form-control" name="productprice" id="productprice" placeholder="Product Price"> <!-- pretul produsului -->
			  </div>
			  <div class="form-group">
			    <label for="productimage">Product Image</label>
			    <input type="file" name="productimage" id="productimage"> <!-- incarcare imagine-->
			    <p class="help-block">Only jpg/png are allowed here!</p>
			  </div>
			  
			  <button type="submit"  name ='submit' class="btn btn-primary" style="background-color:#D98880; border: none;">Submit</button>
			</form>
			
		</div>
	</div>

</section>
</div>
</div>

</div>


<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php'); ?>