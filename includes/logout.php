<?php
session_start();
if(isset($_SESSION)) {
foreach ($_SESSION as $key => $value) {
 session_unset();
}
 session_write_close();
header("Location: ../index.php");
	
}


?>