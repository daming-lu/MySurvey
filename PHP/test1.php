<?php
//------------------------------------------------------------------------------------------
file_put_contents("../logs/log2","_POST : ".print_r($_POST,true)."\n", FILE_APPEND|LOCK_EX);

//------------------------------------------------------------------------------------------
// get all the inputs
	
$FullName 	= $_POST['FullName'];
$Gender 	= $_POST['sGender'];
$Company 	= isset($_POST['company']) ? $_POST['company'] : "no company";
$ZipCode 	= $_POST['zipcode'];
$Driver 	= $_POST['drive'];
$CarAccomm 	= $_POST['sCarPeople'];
$Dates	 	= $_POST['date'];		// concatenate by '|'
$Email	 	= $_POST['email'];
$Cell	 	= $_POST['cell'];
$comments	= isset($_POST['comments'])?$_POST['comments']:"no comment";

//------------------------------------------------------------------------------------------
// concatenate dates

$newDates = $Dates[0];
for($i=1; $i<count($Dates); $i++){
	$tmp = "|".$Dates[$i];
	$newDates += $tmp;
}

//------------------------------------------------------------------------------------------
// connect to DataBase

$host="mysql.peirongli.dreamhosters.com"; 	// Host name 
$username="daming"; 						// Mysql username 
$password="FitnessManager"; 				// Mysql password 
$db_name="damingdb"; 						// Database name 
$tbl_name="Paintball"; 						// Table name 

// Connect to server and select databse.
$con = mysqli_connect("$host", "$username", "$password","$db_name");

$sql="INSERT INTO Paintball (FullName, Gender, Company, ZipCode, Driver, CarAccomm, Dates, Email, Cell, Comments) VALUES ('$FullName','$Gender','$Company','$ZipCode','$Driver','$CarAccomm','$newDates','$Email','$Cell','$comments')";

mysqli_query($con,$sql);

mysqli_close($con);

//------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------
header("location: http://peirongli.dreamhosters.com/MySurvey/MainPage.html");

?>
