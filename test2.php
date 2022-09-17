<?php

require_once 'includes/autoload.inc.php';

session_start();
$u = $_SESSION['user'];

echo $u->getUsername();
echo "Ciao";
