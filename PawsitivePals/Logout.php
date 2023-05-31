<?php

session_start();

echo "Thank you & hope you visit again!";

header('location:Login.php');

session_unset();
session_destroy();

?>