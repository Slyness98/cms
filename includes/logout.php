<?php
ob_start();
session_start();
if(isset($_SESSION)) {
foreach ($_SESSION as $key => $value) {
 session_unset();
}
 session_write_close();
 session_destroy();
header("Location: ../index.php");
	
}


?>