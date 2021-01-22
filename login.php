<?php 
//preluam tot din fisierul specificat - partea de header 
include('inc/header.php');  ?>

<?php 
//preluam tot din fisierul specificat - partea de navigation bar
include('inc/nav.php');  ?>
 

<!-- cum va arata concret pagina de login si register -->  
<div class="container text-white">
    <div class="row">
      <div class="col-md-12 my-5">
        <div class="page_header text-center">
            <h2 style="text-align: center; color:#D98880;"><b>Login & Create New Account</b></h2>
           
        </div>
      </div>

        <div class="col-md-12">
    <div class="row shop-login">
    <div class="col-md-6">
        <div class="box-content">
            <h3 class="heading text-center" style="text-align: center; color:#D98880;">LOGIN</h3>
            <div class="clearfix space40"></div>

            <?php
            if(isset($_REQUEST['message'])){//verifica daca acea variabila este setata- colectare date
                if($_GET['message'] == '1'){ //mesajul de eroare de la login 
 ?>

   <div class="alert alert-danger">Something went wrong.. Please Try Again!</div>


<?php

                }
            }
            ?>
            <form class="logregform" action='loginProcess.php' method='post'>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style ="color:#383c45">E-mail Address</label>
                            <input type="text" value="" class="form-control" name='email' placeholder="E-mail">
                        </div>
                    </div>
                </div>
                <div class="clearfix space20"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style ="color:#383c45">Password</label>
                            <input type="password" value="" class="form-control" name='password' placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="clearfix space20"></div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" name='submit' class="btn button btn-md pull-right" style ="content:center; background-color:#D98880 ; color: #ffffff;  width: 540px; border-radius: 30px;">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box-content">
            <h3 class="heading text-center" style="text-align: center; color:#D98880;">CREATE YOUR ACCOUNT</h3>
            <div class="clearfix space40"></div>

            <?php
            if(isset($_REQUEST['message'])){
                if($_GET['message'] == '2'){ //mesajul de eroare de la register
 ?>

    <div class="alert alert-danger">Error Creating Account</div>


<?php

                }
            }
            ?>
            <form class="logregform" action='registerprocess.php' method='post'>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label style ="color:#383c45">E-mail Address</label>
                            <input type="text" value="" class="form-control" name='email' placeholder="E-mail">
                        </div>
                    </div>
                </div>
                <div class="clearfix space20"></div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label style ="color:#383c45">Password</label>
                            <input type="password" value="" class="form-control" name='password' placeholder="Password">
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="space20"></div>
                        <button type="submit"  name='submit' class="btn button btn-md pull-right" style =" justify-content:center; background-color:#D98880 ; color: #ffffff;  width: 540px; border-radius: 30px;">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


                
        </div>
    </div>

   

   
</div>





<?php 
//preluam tot din fisierul specificat 
include('inc/footer.php');  ?>



