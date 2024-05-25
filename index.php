<?php

session_start();
$_SESSION['login'] = "vide";
header('Location: app/router/router2.php?action=truc');

?>



