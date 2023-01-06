<?php
// requête pour détruire la session. utilisé pour la déconnexion.
session_start();
session_destroy();
header("location:index.php");
?>