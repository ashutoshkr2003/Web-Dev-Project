<?php

session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
setlocale(LC_MONETARY, 'en_IN');

// Remote
//$servername = "localhost";
//$username = "u843180945_testDBMS";
//$password = "DBMSCode@1423";
//$dbname = "u843180945_dbms";

// Local
$servername = "localhost";
$username = "test";
$password = "password";
$dbname = "simplikart";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function moneyFormatIndia($num, $decimal = 2) {
    $explrestunits = "";
    $num = sprintf('%.' . $decimal . 'f', $num);
    $nums = explode('.', $num);
    
    // Handle the whole number part
    if(strlen($nums[0]) > 3) {
        $lastthree = substr($nums[0], strlen($nums[0])-3, strlen($nums[0]));
        $restunits = substr($nums[0], 0, strlen($nums[0])-3);
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits;
        $expunit = str_split($restunits, 2);
        
        for($i=0; $i<sizeof($expunit); $i++) {
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].",";
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $nums[0];
    }
    
    // Add decimal part if it exists
    if(isset($nums[1])) {
        $thecash .= '.' . $nums[1];
    }
    
    return '₹' . $thecash; // Add Rupee symbol
}

?>