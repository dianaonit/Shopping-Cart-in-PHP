<?php
//incepe o sesiune
session_start();
unset($_SESSION['cart']);

//se elimita toate variabilele de sesiune globale si distruge sesiunea
session_destroy();
//trimitere catre login.php
header('location:login.php')

?>