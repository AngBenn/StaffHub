<?php
//local DB config
$SERVER="127.0.0.1";
$USERNAME="root";
$PASSWRD="k0:KW2vSXAfS";
$DATABASE="staff_mgt";


$con=mysqli_connect($SERVER,$USERNAME,$PASSWRD, $DATABASE) or die ("could not connect database");

//check connection:
if ($con-> connect_error) {
    die ("Connection failed: ".$con-> connect_error);
}
