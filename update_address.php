<?php  
//preluam tot din fisierul specificat - partea de header
 include('inc/header.php'); 

 //preluam tot din fisierul specificat - partea de navigation bar
 include('inc/nav.php');  
 
//preluam tot din fisierul specificat - partea de conectare la baza de date 
include('config/db.php');


//nu se poate accesa pagina de update_address.php daca nu suntem logati 
if(!isset($_SESSION['customer']) && empty($_SESSION['customer']) ){
 header('location:login.php');
}

 
if(!isset($_SESSION['customerid'])){
	echo '<script>window.location.href = "login.php";</script>';

}
 


$message  = '';
$_POST['agree'] = 'false';

if(isset($_POST['submit'])){
	 
	 
	$country = $_POST['country'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$companyName = $_POST['companyName'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$city = $_POST['city'];
	$Postcode = $_POST['Postcode'];
	$Email = '';
	$Phone = $_POST['Phone'];
	$payment = '';
    $cid = $_SESSION['customerid']; 
    

$sql = "SELECT * FROM user_data where userid = $cid";
$result = mysqli_query($conn, $sql);//efectuare interogare
$row = mysqli_fetch_assoc($result);//preluare rand de rezultate ca o matrice asociativa


if (mysqli_num_rows($result) == 1) {//returnare numar de randuri din setul de rezultate
//   update query
$up_sql = "UPDATE user_data SET firstname='$fname', lastname='$lname', company='$companyName', address1='$addr1', address2='$addr2', city='$city', country='$country', zip='$Postcode', mobile='$Phone'  WHERE userid=$cid";

$Updated = mysqli_query($conn, $up_sql);//efectuare interogare
     	 
}

}
 

$cid =$_SESSION['customerid'];

$sql = "SELECT * FROM user_data where userid = $cid";
$result = mysqli_query($conn, $sql);//efectuare interogare
$row = mysqli_fetch_assoc($result);//preluare rand de rezultate ca o matrice asociativa

?>

<div class="container text-white">

<?php




if(isset($_SESSION['cart'])){//verificare daca variabila este setata
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
						<h2 style="color:#D98880;">Update Address</h2>
						 
					</div>
<form method='post'>
<?php echo $message ?>
<div class="container ">
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
						<h3 class="uppercase" style="color:#D98880;">Billing Details</h3>
						<div class="space30"></div>
					 
							<label style="color:#302e2e">Country </label>
							<select class="form-control" name='country'>
								<option value="">Select Country</option>
								<option value="AF">Afghanistan</option>
								<option value="AL">Albania</option>
								<option value="DZ">Algeria</option>
								<option value="AD">Andorra</option>
								<option value="AO">Angola</option>
								<option value="AI">Anguilla</option>
								<option value="AQ">Antarctica</option>
								<option value="AG">Antigua and Barbuda</option>
								<option value="AR">Argentina</option>
								<option value="AM">Armenia</option>
								<option value="AW">Aruba</option>
								<option value="AU">Australia</option>
								<option value="AT">Austria</option>
								<option value="AZ">Azerbaijan</option>
								<option value="BS">Bahamas</option>
								<option value="BH">Bahrain</option>
								<option value="BD">Bangladesh</option>
								<option value="BB">Barbados</option>
								<option value="RO">Romania</option>
							</select>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-6">
									<label style="color:#302e2e">First Name </label>
									<input class="form-control" name='fname' placeholder="" value="<?php if(isset($row['firstname'])) { echo $row['firstname']; } ?>" type="text">
								</div>
								<div class="col-md-6">
									<label style="color:#302e2e">Last Name </label>
									<input class="form-control" name='lname' placeholder="" value="<?php if(isset($row['lastname'])) {echo $row['lastname']; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label style="color:#302e2e">Company Name</label>
							<input class="form-control" name='companyName' placeholder="" value="<?php if(isset($row['company'])) {echo $row['company']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<label style="color:#302e2e">Address </label>
							<input class="form-control" name='addr1' placeholder="Street address" value="<?php if(isset($row['address1'])) {echo $row['address1']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<input class="form-control" name='addr2' placeholder="Apartment, suite, unit etc. (optional)" value="<?php if(isset($row['address2'])) {echo $row['address2'];  } ?>" type="text">
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-4">
									<label style="color:#302e2e">Town / City </label>
									<input class="form-control" name='city' placeholder="Town / City" value="<?php if(isset($row['city'])) {echo $row['city']; } ?>" type="text">
								</div>
 
								<div class="col-md-4">
									<label style="color:#302e2e">Postcode </label>
									<input class="form-control" name='Postcode' placeholder="Postcode / Zip" value="<?php if(isset($row['zip'])) {echo $row['zip']; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<div class="clearfix space20"></div>
							<label style="color:#302e2e">Phone </label>
							<input class="form-control" name='Phone'  id="billing_phone" placeholder="" value="<?php if(isset($row['mobile'])) {echo $row['mobile']; } ?>" type="text">
						 
					</div>
				</div>
				
			 
			</div>
		
        </div>		
        
        <div class="row">
            <div class="col-md-12 text-center">
                <input type='submit' name='submit' value='Update Address' class="btn"style =" justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 200px; border-radius: 30px;">
            </div>
        </div>
		
		</div>
	</section>
</div>

</form>


<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php');  ?>


