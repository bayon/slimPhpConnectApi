<?php
//per tutorial: https://www.youtube.com/watch?v=kt2hWLZNO9c&list=PLBEpR3pmwCayt4DR0UbhMgCfxHQWi0RCQ&index=5
//display_errors('ALL');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

 

$app->post('/api/login', function (Request $request, Response $response, array $args) {
    require_once('dbconnect_connectAPP.php');
    if( !isset( $_POST['username'] ) ) { exit( json_encode([0, "missing parameters"])); }
    if( !isset( $_POST['password'] ) ) { exit( json_encode([0, "missing parameters"])); }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
        
    $query = 'SELECT * FROM users WHERE email="'.$_POST['username'].'"';
    //die($query);
    $result= $mysqli->query($query);
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // if isset , then is either a user or an organization.
    if(isset($data)) {
       // is either a regular user  
        
        $login_type = "user";
        $user = $data[0];
        $user_id = $user['id'];
        $login_token = bin2hex(openssl_random_pseudo_bytes(32));
        $login_token_time = time();
       
        $user_sql = "UPDATE users SET login_token = '".$login_token."' , login_token_time=  '".$login_token_time."'  WHERE id=  '".$user_id."' ";
        $user_result= $mysqli->query($user_sql);
        $response = [1, $user, $login_type ];
        header('content-type: application/json');
        echo json_encode($response);

    }else{
        //echo("if not regular user check if organization...");
        $query = 'SELECT * FROM organizations WHERE email="'.$_POST['username'].'"';
        $result= $mysqli->query($query);
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        if(isset($data)) {
            // echo("is admin");
            $org = $data[0];
            $org_id = $org['id'];
            $login_token = bin2hex(openssl_random_pseudo_bytes(32));
            $login_token_time = time();
            $login_type = "organization";
            $admin_sql = "UPDATE organizations SET login_token = '".$login_token."' , login_token_time=  '".$login_token_time."'  WHERE id=  '".$org_id."' ";
            $admin_result= $mysqli->query($admin_sql);
            $response = [1, $org, $login_type ];
            header('content-type: application/json');
            echo json_encode($response);
        
        }else{
            echo("something wrong not user or organization");
        }
   
    }
    
/*
expecting result like: 
    [
    1,
    {
        "id": "67",
        "name": "Forteworks",
        "email": "admin@forteworks.com",
        "password": "mlqtnLMpUa2lUsSHgSkSTNsP0WxEryuWWHoVnmCB4Y=",
        "login_token": "18b5120051da18bf0e38ddb2ba8e9aa6ea89fdac1f8609942fcafba55aa78e71",
        "login_token_time": 1550356596,
        "time_created": "1546465217",
        "confirmation_number": "hbjtjjwpi5n75ntii4lo",
        "confirmed": "0"
    },
    "organization"
]
*/





   
});

$app->get('/api/users', function (Request $request, Response $response, array $args) {
    require_once('dbconnect_connectAPP.php');
    $query="select * from users order by id";
    //die($query);
    $result= $mysqli->query($query);
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    if(isset($data)) {
        header('content-type: application/json');
        echo json_encode($data);
    }
});

$app->get('/api/users/{id}', function (Request $request, Response $response, array $args) {
    require_once('dbconnect_connectAPP.php');
    $id = $request->getAttribute('id');
    $query="select * from users where id =$id";
    $result= $mysqli->query($query);
    $data[] = $result->fetch_assoc();
    
    if(isset($data)) {
        header('content-type: application/json');
        echo json_encode($data);
    }
});



$app->get('/api/books', function (Request $request, Response $response, array $args) {
    require_once('dbconnect.php');
    $query="select * from books order by id";
    //die($query);
    $result= $mysqli->query($query);
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    if(isset($data)) {
        header('content-type: application/json');
        echo json_encode($data);
    }
});

$app->get('/api/books/{id}', function (Request $request, Response $response, array $args) {
    require_once('dbconnect.php');
    $id = $request->getAttribute('id');
    $query="select * from books where id =$id";
    $result= $mysqli->query($query);
    $data[] = $result->fetch_assoc();
    
    if(isset($data)) {
        header('content-type: application/json');
        echo json_encode($data);
    }
});
 

$app->run();