<?php
//------------------------------------------------------------------------------------------
file_put_contents("../logs/log2","_POST : ".print_r($_POST,true)."\n", FILE_APPEND|LOCK_EX);
$columns = array(
	"PersonID","FullName","Gender","Company","ZipCode","Driver","CarAccomm","Dates","Email","Cell","Comments"
);
//------------------------------------------------------------------------------------------
// get all the inputs
	
$FullName 	= $_POST['FullName'];
$Gender 	= $_POST['sGender']=="girl" ? 0 : 1;
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

file_put_contents("../logs/log4","Dates : ".print_r($Dates,true)."\n", FILE_APPEND|LOCK_EX);

$newDates = $Dates[0];
for($i=1; $i<count($Dates); $i++){
	$tmp = "|".$Dates[$i];
	$newDates .= $tmp; // .= !!! += is arithmetic!
}
//file_put_contents("../logs/log3","newDates : ".print_r($newDates,true)."\n", FILE_APPEND|LOCK_EX);

//------------------------------------------------------------------------------------------
// connect to DataBase

$host="mysql.peirongli.dreamhosters.com"; 	// Host name 
$username="daming"; 						// Mysql username 
$password="FitnessManager"; 				// Mysql password 
$db_name="damingdb"; 						// Database name 
$tbl_name="Paintball"; 						// Table name 

// connect to db and insert
$con = mysqli_connect("$host", "$username", "$password","$db_name");

$sql="INSERT INTO Paintball (FullName, Gender, Company, ZipCode, Driver, CarAccomm, Dates, Email, Cell, Comments) VALUES ('$FullName','$Gender','$Company','$ZipCode','$Driver','$CarAccomm','$newDates','$Email','$Cell','$comments')";

mysqli_query($con,$sql);

// then query db to get the latest list

$sql="SELECT * FROM $tbl_name";


$result=mysqli_query($con,$sql);
$i=0;

// for pie charts
$dataBlobs = array();
$Dates = array(
	"Apr19" 	=> 0,
	"Apr20" 	=> 0,
	"Apr26" 	=> 0,
	"Apr27" 	=> 0,
	"May3" 		=> 0,
	"May4" 		=> 0,
	"May10" 	=> 0,
	"May11" 	=> 0
);
$DatesMapping = array(
	"Apr19" 	=> "Apr 19",
	"Apr20" 	=> "Apr 20",
	"Apr26" 	=> "Apr 26",
	"Apr27" 	=> "Apr 27",
	"May3" 		=> "May  3",
	"May4" 		=> "May  4",
	"May10" 	=> "May 10",
	"May11" 	=> "May 11"
);
$boys = 0;
$girls = 0;

while($row = mysqli_fetch_array($result)) {
	$i++;
	file_put_contents("../logs/log3","row [$i]: ".print_r($row,true)."\n", FILE_APPEND|LOCK_EX);
	$dataBlobs []= $row;
	$curDates = $row['Dates'];
	$dates = explode("|", $curDates);
	foreach($dates as $date) {
		$Dates[$date]++;
	}
	if ($row['Gender'] == 0) {
		$girls++;
	} else {
		$boys++;
	}
}

file_put_contents("../logs/log1","Dates : ".print_r($Dates,true)."\n", FILE_APPEND|LOCK_EX);
file_put_contents("../logs/log2","dataBlobs : ".print_r($dataBlobs,true)."\n", FILE_APPEND|LOCK_EX);
file_put_contents("../logs/log2","boys $boys and girls $girls\n", FILE_APPEND|LOCK_EX);

// Pie for Gender
file_put_contents("../d3/data.csv","age,population\n$girls,$boys\n");

// Arch for Dates
file_put_contents("../arch/data.csv","age,population\n");

for($i=0; $i<count($Dates); $i++) {
	file_put_contents("../arch/data.csv","$DatesMapping[$Dates[$i]],\n");
}

foreach ($Dates as $key => $value) {
	file_put_contents("../arch/data.csv","$DatesMapping[$key],$value\n", FILE_APPEND|LOCK_EX);
}
// >> 

mysqli_close($con);

//------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------
//header("location: http://peirongli.dreamhosters.com/MySurvey/MainPage.html");

?>
