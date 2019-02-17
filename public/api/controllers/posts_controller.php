<?php 

require_once('_dbconnect.php');

/*
Description:

*/

/* Check Request Parameters:
if( !isset( $_POST['username'] ) ) { exit( json_encode([0, "missing parameters"])); }
 
*/

/* Query The Database and Create Response
$query = 'SELECT * FROM users WHERE email="'.$_POST['username'].'"';
$result= $mysqli->query($query);
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
if(isset($data)) {
   // create response  
    header('content-type: application/json');
    echo json_encode($response);
} 
*/

/*
Expected Response Format:


*/



