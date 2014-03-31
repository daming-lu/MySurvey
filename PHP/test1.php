<?php
$myusername=$_POST['username1'];
file_put_contents("../logs/log1","username1 : ".$myusername."\n", FILE_APPEND|LOCK_EX);
file_put_contents("../logs/log2","_POST : ".print_r($_POST,true)."\n", FILE_APPEND|LOCK_EX);
	
header("location: http://peirongli.dreamhosters.com/MySurvey/MainPage.html");

?>
