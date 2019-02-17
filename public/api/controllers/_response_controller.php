<?php 

function response($args,$type){
    if($args){
        if($type==="json"){
            header('content-type: application/json');
            echo json_encode($args);
        } else if($type==="php"){
            header('content-type: text');
            print_r($args);
        }
        else{
            //echo("incorrect server response type");
            //Default Response in JSON
            header('content-type: application/json');
            echo json_encode($args);
        }
    }else{
        header('content-type: application/json');
        $response = '{"response":"missing appropriate data"}';
        echo ($response);
    }
  
   
}