<?php 
$host="localhost";
$user="root";
$pass="root";
$db_name="connect";
$mysqli = new mysqli($host,$user,$pass, $db_name);

include('_response_controller.php');

function queryDB($mysqli,$args){
   
    $result= $mysqli->query($args);
    
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}