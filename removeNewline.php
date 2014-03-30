<?php
$inFileName = "FrontPage.html";
$outFileName = "noNLFrontPage.html";

$handle = @fopen($inFileName, "r");

if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $buffer = trim($buffer);
        if(strlen($buffer)<1){
        	continue;
        }	
        file_put_contents($outFileName, $buffer."\n", FILE_APPEND|LOCK_EX);
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

?>