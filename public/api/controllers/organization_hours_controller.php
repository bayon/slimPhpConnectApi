<?php 

require_once('_dbconnect.php');

/*
Description:
*/

/* 
Check Request Parameters:
*/
 
/* 
Query The Database and Create Response
*/

if($args){
    // get record(s) with criteria
   //print_r($args);
     // get all records 
     $query = "SELECT * FROM organization_hours WHERE organization_id = '".$args['id']."' ";
     $data =  queryDB( $mysqli, $query);
     
     if(isset($data)) {
        response($data, 'json');
     } 
    
    
}else{
    // get all records 
    $query = "SELECT * FROM organization_hours ";
    $data =  queryDB( $mysqli, $query);
     
    if(isset($data)) {
       response($data, 'json');
    } 
} 





/*
Expected Response Format:


*/



