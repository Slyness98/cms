<?php
$db['db_host'] = "localhost";
$db['db_user'] = "tyuskumy_seth";
$db['db_pass'] = "[!NF?;{_cT=J";
$db['db_name'] = "tyuskumy_cmsTest";
//db array of constants being defined. More secure way of passing db keys through mysqli_connect.
foreach ($db as $key => $value) {
	define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS, DB_NAME);
if($connection){
	//echo "connected to cms";
}

?>