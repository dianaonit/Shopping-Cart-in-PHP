<?php 
//preluam tot din fisierul specificat - partea de header 
include('inc/header.php');

//se incepe o sesiune 
session_start();

//preluam tot din fisierul specificat - conectarea la baza de date 
include('../config/db.php');
 
//se verifica daca exista un camp cu numele "submit" in formularul trimis la aceasta pagina php( cu alte cuvinte arata ca formularul a fost trimis si procesat)
if(isset($_POST['submit'])){
     $email = mysqli_real_escape_string($conn, $_POST['email']);//se scapa de caracterele speciale din sir pentru a fi utilizate in interogarea urmatoare
     //cripatare parola
     $password = md5($_POST['pswd']);
    
     $sql = "SELECT * FROM admin_data WHERE email='$email' and password='$password'";
     $result = mysqli_query($conn, $sql);//efectuare interogare 


if (mysqli_num_rows($result) > 0) {//returnare numar de randuri din setul de rezultate
     $_SESSION['email'] = $email;
     //trimitere catre pagina index.php
     header('location:index.php');
  } else {
   $message =  'Something went wrong.. Please Try Again!';
  }
  
}

?>
<!-- cum va arata concret pagina de login  -->  
<div class="container pt-5">
    <h2 style="text-align: center; color:#D98880;"><b>Admin Login</b></h2>
    <div class="row text-white mt-5">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="box-content">
                <div class="clearfix space40"></div>
                <form class="logregform" method='post'>
                    <div class="row">
                        <div class="col-md-12">
                           <?php 
                           //afisare mesaj :Something went wrong.. Please Try Again!
                            if(isset($message)){//verifica daca variabila este setata
                                echo  "<div class='alert alert-danger'>".$message. "</div>";
                            }
                           ?>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style ="color:#383c45">E-mail Address</label>
                                <input type="text" value="" class="form-control" name='email' placeholder="E-mail Address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                               
                                <label style ="color:#383c45">Password</label>
                                <input type="password" value="" class="form-control" name='pswd' placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" >
                            <button type="submit" name='submit' class="btn button btn-md pull-right" style =" justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 200px; border-radius: 30px;"><b>Login</b></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php 
//preluam tot din fisierul specificat 
include('inc/footer.php') ?>
 