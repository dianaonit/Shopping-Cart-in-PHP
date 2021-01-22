<?php
//incepe o sesiune
session_start();

//preluam tot din fisierul specificat - conectarea la baza de date
include('../config/db.php');

//daca se incearca intrarea directa pe pagina editProducts.php vom fi redirectionati  catre pagina de login- doar admin-ul are acces aici 
if(!isset($_SESSION['email']) && empty($_SESSION['email']) ){
 header('location:login.php');
}

if(isset($_GET['id']) & !empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT thumb FROM products WHERE product_id=$id";
    $res = mysqli_query($conn, $sql);//efectuare interogare
    $r = mysqli_fetch_assoc($res);//preluare rand de rezultate ca o matrice asociativa
    
 
 //update imagine produs
    if(!empty($r['thumb'])){//verificare daca variabila este goala
        if(unlink($r['thumb'])){//stergere fisier/imagine
            $delsql = "UPDATE products SET thumb='' WHERE product_id=$id";
            if(mysqli_query($conn, $delsql)){//efectuare interogare
                header("location:editproducts.php?id={$id}");
            }
        }else{
            $delsql = "UPDATE products SET thumb='' WHERE product_id=$id";
            if(mysqli_query($conn, $delsql)){//efectuare interogare
                header("location:editproducts.php?id={$id}");
            }
        }

}
}



