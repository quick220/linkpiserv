<?php
ini_set('session.gc_maxlifetime', 864000);
session_start(); 
if($_SESSION['login']!="admin" && $_SESSION['login']!="superadmin")
{
	header("Location:/login.php"); 
	exit();
}
?>