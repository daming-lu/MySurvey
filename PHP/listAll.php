<?php

//------------------------------------------------------------------------------------------
// connect to DataBase

$host="mysql.peirongli.dreamhosters.com"; 	// Host name 
$username="daming"; 						// Mysql username 
$password="FitnessManager"; 				// Mysql password 
$db_name="damingdb"; 						// Database name 
$tbl_name="Paintball"; 						// Table name 

// connect to db and list all
$con = mysqli_connect("$host", "$username", "$password","$db_name");

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
	if(empty($row['FullName'])){
		continue;
	}
	$i++;
	//file_put_contents("../logs/log3","row [$i]: ".print_r($row,true)."\n", FILE_APPEND|LOCK_EX);
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
//file_put_contents("../logs/log2","dataBlobs : ".print_r($dataBlobs,true)."\n", FILE_APPEND|LOCK_EX);
//file_put_contents("../logs/log2","boys $boys and girls $girls\n", FILE_APPEND|LOCK_EX);

// Pie for Gender
file_put_contents("../d3/data.csv","age,population\nboys,$boys\ngirls,$girls\n");

// Arch for Dates
file_put_contents("../arch/data.csv","age,population\n");
foreach ($Dates as $key => $value) {
	file_put_contents("../arch/data.csv","$DatesMapping[$key],$value\n", FILE_APPEND|LOCK_EX);
}
// >> 

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">    
<head>
	<title>Survey Results</title>
</head>
<body>

    <table style="width:1590px;height:440px">
        <tr>
          <td>
            <iframe width="640px" height="400px" src="http://peirongli.dreamhosters.com/MySurvey/d3/indexPie.html"></iframe>
          </td>            
          <td>
            <iframe width="640px" height="400px" src="http://peirongli.dreamhosters.com/MySurvey/arch/indexArch.html"></iframe>
          </td>
        </tr>
	</table>
    <p></p>
    <table border="1" style="width:1450px">
        <tr align="right">
            <td><b>姓名       </b></td>
            <td><b>手机       </b></b></td>
            <td><b>电邮       </b></td>
            <td><b>公雌       </b></td>
            <td><b>单位       </b></td>
            <td><b>邮政编码    </b></td>
            <td><b>是否开车    </b></td>
            <td><b>宰人能力     </b></td>
            <td><b>可行的时间   </b></td>        
            <td><b>有话要说     </b></td>
        </tr>
        <?php
            foreach($dataBlobs as $person) {
                echo '<tr align="right">';
                echo '<td>'.$person['FullName'].'</td>';
                echo '<td>'.$person['Cell'].'</td>';
                echo '<td>'.$person['Email'].'</td>';
    
                if ($person['Gender'] == 0) {
                    echo '<td>女生</td>';
                } else{
                    echo '<td>男生</td>';   
                }
                
                echo '<td>'.$person['Company'].'</td>';                
                echo '<td>'.$person['ZipCode'].'</td>';
                echo '<td>'.$person['Driver'].'</td>';
                echo '<td>'.$person['CarAccomm'].'</td>';
    
                $datesComma = str_replace("|", ", ", $person['Dates']);
                echo '<td>'.$datesComma.'</td>';
                echo '<td>'.$person['Comments'].'</td>';
                echo '</tr>';
            }
        ?>
    
    </table>

</body>
</html>
