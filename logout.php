<?php
session_start();
include_once "includes/connection.php";
session_destroy();
header("Location: index.php");
exit;
?>