<?php
$myusername=$_POST['username'];
file_put_contents("../logs/log1","username : ".$myusername."\n", FILE_APPEND|LOCK_EX);
file_put_contents("../logs/log2","_POST : ".print_r($_POST,true)."\n", FILE_APPEND|LOCK_EX);
?>
