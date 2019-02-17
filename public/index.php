<?php
//per tutorial: https://www.youtube.com/watch?v=kt2hWLZNO9c&list=PLBEpR3pmwCayt4DR0UbhMgCfxHQWi0RCQ&index=5
//display_errors('ALL');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

 

$app->post('/api/login', function (Request $request, Response $response, array $args) {
    
    include('./api/login_controller.php');
    
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