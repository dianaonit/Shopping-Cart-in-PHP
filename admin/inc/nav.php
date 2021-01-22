 
<!--partea de navigation bar  -->

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" >
  <!-- numele site-ului -->
  <a class="navbar-brand" href="index.php">Come & Go Shop</a>

  <!-- link-urile din navigation bar  -->
  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Categories
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="categories.php">View Categories </a>
          <a class="dropdown-item" href="addCategory.php">Add Categories</a> 
        </div>
      </li>


      <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Products
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="products.php">View Products </a>
          <a class="dropdown-item" href="addProducts.php">Add Products</a> 
        </div>
      </li>

      <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Orders
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="orders.php">View Orders </a>
        </div>
      </li>

      
      <li class="nav-item dropdown mt-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            My Account
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="logout.php">Logout</a> 
        </div>
      </li>
 
</nav>
