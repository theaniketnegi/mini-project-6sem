<?php
session_start();
require_once("../dbconnect.php");

if($_SESSION["user_role"]!="Admin"){
	session_destroy();
	session_unset();
	?>
	<script>location.assign("../index.php");</script>
	<?php
}
?>