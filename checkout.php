<?php  
//preluam tot din fisierul specificat - partea de header
include('inc/header.php'); 

//preluam tot din fisierul specificat - partea de navigation bar
include('inc/nav.php');  
 
//preluam tot din fisierul specificat - partea de conectare la baza de date 
include('config/db.php');

//nu se poate accesa pagina de checkout.php daca nu suntem logati 
if(!isset($_SESSION['customer']) && empty($_SESSION['customer']) ){
 header('location:login.php');
}

 
if(!isset($_SESSION['customerid'])){
	echo '<script>window.location.href = "login.php";</script>';

}


$total = 0;
if(isset($_SESSION['cart'])){
	 $cart = $_SESSION['cart'];
	foreach($cart as $key => $value){
	 
	 $sql_cart = "SELECT * FROM products where product_id = $key";
	$result_cart = mysqli_query($conn, $sql_cart);
	$row_cart = mysqli_fetch_assoc($result_cart);
	$total = $total +  ($row_cart['price'] * $value['quantity']);
}
}


$message  = '';
$_POST['agree'] = 'false';

if(isset($_POST['submit'])){
	 
	if($_POST['agree'] == true){
	$country = $_POST['country'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$companyName = $_POST['companyName'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$city = $_POST['city'];
	$state = '';
	$Postcode = $_POST['Postcode'];
	$Email = '';
	$Phone = $_POST['Phone'];
	$payment = $_POST['payment'];
	$agree = $_POST['agree'];
	$cid = $_SESSION['customerid']; 
	$sql = "SELECT * FROM user_data where userid = $cid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if (mysqli_num_rows($result) == 1) {
//   update query
$up_sql = "UPDATE user_data SET firstname='$fname', lastname='$lname', company='$companyName', address1='$addr1', address2='$addr2', city='$city', country='$country', zip='$Postcode', mobile='$Phone'  WHERE userid=$cid";

$Updated = mysqli_query($conn, $up_sql);
if($Updated){

	if(isset($_SESSION['cart'])){
		$total = 0;
		foreach($cart as $key => $value){
		 
		$sql_cart = "SELECT * FROM products where product_id = $key";
		$result_cart = mysqli_query($conn, $sql_cart);
		$row_cart = mysqli_fetch_assoc($result_cart);
		$total = $total +  ($row_cart['price'] * $value['quantity']);
	}
	}


	//update la table order si table orderitems

	$insertOrder = "INSERT INTO orders (userid, totalprice, orderstatus, paymentmode ) VALUES ('$cid', '$total', 'Order Placed', '$payment')";  

	if(mysqli_query($conn, $insertOrder)){
	 
		$orderid = mysqli_insert_id($conn); //returnare id  generat din ultima interogare
		foreach($cart as $key => $value){ 
			$sql_cart = "SELECT * FROM products where product_id = $key";
		   $result_cart = mysqli_query($conn, $sql_cart);
		   $row_cart = mysqli_fetch_assoc($result_cart); //se preia randul de rezultate ca o matrie asociativa - array 
			$price_product = $row_cart["price"];
			 $q  = $value["quantity"];
		   $insertordersItems = "INSERT INTO ordersItems (orderid, productid, quantity, productprice) 
		    VALUES ('$orderid', '$key', '$q', '$price_product')";
		   
		   if(mysqli_query($conn, $insertordersItems)){//efectuare interogare
			
			unset($_SESSION['cart']);//dezactivare sesiune cart
			
			echo '<script>window.location.href = "myaccount.php";</script>';

		
		   }
	   }
	}
}
} else {
  // inseereaza
 
  $ins_sql = "INSERT INTO user_data (userid, firstname, lastname, company, address1, address2, city, country, zip, mobile) VALUES ('$cid', '$fname', '$lname', '$companyName', '$addr1', '$addr2', '$city', '$country', '$Postcode', '$Phone')"; 
$inserted = mysqli_query($conn, $ins_sql);//efectuare interogare
if($inserted){
	// inserare orderitems si order ;
	
	if(isset($_SESSION['cart'])){//se verifica daca variabila pentru sesiune este setata
		$total = 0;
		foreach($cart as $key => $value){
		 
		$sql_cart = "SELECT * FROM products where product_id = $key";
		$result_cart = mysqli_query($conn, $sql_cart);//efectuare interogare
		$row_cart = mysqli_fetch_assoc($result_cart);//se preia randul de rezultate ca o matrice asociativa
		$total = $total +  ($row_cart['price'] * $value['quantity']);
	}
	}


	// update la orderitems si order;

	$insertOrder = "INSERT INTO orders (userid, totalprice, orderstatus, paymentmode )VALUES ('$cid', '$total', 'Order Placed', '$payment')";  

	if(mysqli_query($conn, $insertOrder)){//efectuare interogare
	 
		$orderid = mysqli_insert_id($conn); //se returneaza id-ul generat din ultima interogare
		foreach($cart as $key => $value){ 
			$sql_cart = "SELECT * FROM products where product_id = $key";
		   $result_cart = mysqli_query($conn, $sql_cart);//efectuare interogare
		   $row_cart = mysqli_fetch_assoc($result_cart); //se preia randul de rezultate ca o matrice asociativa
			$price_product = $row_cart["price"];
			 $q  = $value["quantity"];
		   $insertordersItems = "INSERT INTO ordersItems (orderid, productid, quantity, productprice) 
		    VALUES ('$orderid', '$key', '$q', '$price_product')";
		   
		   if(mysqli_query($conn, $insertordersItems)){//efectuare interogare
			unset($_SESSION['cart']);//dezactivare variabila pt sesiune
			echo '<script>window.location.href = "myaccount.php";</script>';

		
		   }
	   }
	}
}

}
}else{
	$message =  'agreen to terms and condition';
}


}


$cid =$_SESSION['customerid'];

$sql = "SELECT * FROM user_data where userid = $cid";
$result = mysqli_query($conn, $sql);//efectuare interogare
$row = mysqli_fetch_assoc($result);//se preia randul de rezultate  ca o matrice asociativa
 ?>

<!-- cum va arata concret pagina checkout.php -->
<div class="container text-white">

<?php

if(isset($_SESSION['cart'])){//se verifica daca variabila este setata
	$total = 0;
	foreach($cart as $key => $value){
	 
	$sql_cart = "SELECT * FROM products where product_id = $key";
	$result_cart = mysqli_query($conn, $sql_cart);//efectuare interogare
	$row_cart = mysqli_fetch_assoc($result_cart);//se preia randul de rezultate ca o matrice asociativa
	$total = $total +  ($row_cart['price'] * $value['quantity']);
}
}

?>
 
    <section id="content">
		<div class="content-blog">
					<div class="page_header text-center  py-5">
						<h2 style ="color:#D98880 ;">Come & Go Shop - Checkout</h2>
						
					</div>
<form method='post'>
<?php echo $message ?>
<div class="container ">
			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="billing-details">
						<h3 class="uppercase"style ="color:#D98880 ;">Billing Details</h3>
						<div class="space30"></div>
					 
							<label class=""style ="color:#302e2e;">Country </label>
							<select class="form-control" name='country'>
								<option value="">Select Country</option>
								<option value="AX">Aland Islands</option>
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
								<option value="RO">Romania</option>
							</select>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-6">
									<label style ="color:#302e2e;">First Name </label>
									<input class="form-control" name='fname' placeholder="" value="<?php if(isset($row['firstname'])) { echo $row['firstname']; } ?>" type="text">
								</div>
								<div class="col-md-6">
									<label style ="color:#302e2e;">Last Name </label>
									<input class="form-control" name='lname' placeholder="" value="<?php if(isset($row['lastname'])) {echo $row['lastname']; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label style ="color:#302e2e;">Company Name</label>
							<input class="form-control" name='companyName' placeholder="" value="<?php if(isset($row['company'])) {echo $row['company']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<label style ="color:#302e2e;">Address </label>
							<input class="form-control" name='addr1' placeholder="Street address" value="<?php if(isset($row['address1'])) {echo $row['address1']; } ?>" type="text">
							<div class="clearfix space20"></div>
							<input class="form-control" name='addr2' placeholder="Apartment, suite, unit etc. (optional)" value="<?php if(isset($row['address2'])) {echo $row['address2'];  } ?>" type="text">
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-4">
									<label style ="color:#302e2e;">Town / City </label>
									<input class="form-control" name='city' placeholder="Town / City" value="<?php if(isset($row['city'])) {echo $row['city']; } ?>" type="text">
								</div>
 
								<div class="col-md-4">
									<label style ="color:#302e2e;">Postcode </label>
									<input class="form-control" name='Postcode' placeholder="Postcode / Zip" value="<?php if(isset($row['zip'])) {echo $row['zip']; } ?>" type="text">
								</div>
							</div>
							<div class="clearfix space20"></div>
							
							<div class="clearfix space20"></div>
							<label style ="color:#302e2e;">Phone </label>
							<input class="form-control" name='Phone'  id="billing_phone" placeholder="" value="<?php if(isset($row['mobile'])) {echo $row['mobile']; } ?>" type="text">
						 
					</div>
				</div>
				
			 
			</div>
			
			<div class="space30"></div>
			<h4 class="heading" style ="color:#D98880 ;">Your order</h4>
			
			<table class="table table-bordered extra-padding bg-white text-dark">
				<tbody>
					<tr>
						<th>Cart Subtotal</th>
						<td><span class="amount"><?php echo $total?>.00 $</span></td>
					</tr>
					<tr>
						<th>Shipping and Handling</th>
						<td>
							Free Shipping				
						</td>
					</tr>
					<tr>
						<th>Order Total</th>
						<td><strong><span class="amount"><?php echo $total?>.00 $</span></strong> </td>
					</tr>
				</tbody>
			</table>
			
			<div class="clearfix space30"></div>
			<h4 class="heading" style ="color:#D98880 ;">Payment Method</h4>
			<div class="clearfix space20"></div>
			
			<div class="payment-method mt-5">
             
				<div class="row d-flex">
				
						<div class="col-md-4">
							<input name="payment" value='COD'  id="radio1" class="mr-2 css-checkbox" type="radio"><span>COD</span>
							<div class="space20"></div>
							<p style ="color:#302e2e;">Bank account</p>
						</div>
						<div class="col-md-4">
							<input name="payment" value='Cheque'  id="radio2" class="mr-2 css-checkbox" type="radio"><span>Cheque Payment</span>
							<div class="space20"></div>
							<p style ="color:#302e2e;">Cheque</p>
						</div>
						<div class="col-md-4">
							<input name="payment" value='Paypal'  id="radio3" class="mr-2 css-checkbox" type="radio"><span>Paypal</span>
							<div class="space20"></div>
							<p style ="color:#302e2e;">Pay via PayPal</p>
						</div>
				
                </div>
           
						
        
        <div class="row">
            <div class="col-md-12 text-center">
                <input type='submit' name='submit' value='Pay Now' class="btn" style ="justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 100px; border-radius: 30px;">
            </div>
        </div>
		
		</div>
	</section>
</div>

</form>







<?php 
//preluam tot din fisierul specificat - partea de footer
include('inc/footer.php');  ?>


