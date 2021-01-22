<?php
//incepe o sesiune 
session_start();
//se elimina toate variabilele de sesiune globale si se distruge sesiunea
session_destroy();

//se face trimitere la pagina de login 
header('location:login.php')

?>