<?php
//per tutorial: https://www.youtube.com/watch?v=kt2hWLZNO9c&list=PLBEpR3pmwCayt4DR0UbhMgCfxHQWi0RCQ&index=5
//display_errors('ALL');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

// login
$app->post('/api/login', function (Request $request, Response $response, array $args) {
    include('./api/controllers/login_controller.php');
});
//Auth::authorize($_POST);

// events ( event tumbler)
$app->get('/api/events', function (Request $request, Response $response, array $args) {
    include('./api/controllers/events_tumbler_controller.php');
});
$app->get('/api/events/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/events_tumbler_controller.php');
});

// event meta
$app->get('/api/event_meta', function (Request $request, Response $response, array $args) {
    include('./api/controllers/event_meta_controller.php');
});
$app->get('/api/event_meta/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/event_meta_controller.php');
});

// organizations
$app->get('/api/organizations', function (Request $request, Response $response, array $args) {
    include('./api/controllers/organizations_controller.php');
});
$app->get('/api/organizations/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/organizations_controller.php');
});

// ice breakers
$app->get('/api/ice_breakers', function (Request $request, Response $response, array $args) {
    include('./api/controllers/ice_breakers_controller.php');
});
$app->get('/api/ice_breakers/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/ice_breakers_controller.php');
});

 // organization hours
$app->get('/api/organization_hours', function (Request $request, Response $response, array $args) {
    include('./api/controllers/organization_hours_controller.php');
});
$app->get('/api/organization_hours/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/organization_hours_controller.php');
});

// organization meta
$app->get('/api/organization_meta', function (Request $request, Response $response, array $args) {
    include('./api/controllers/organization_meta_controller.php');
});
$app->get('/api/organization_meta/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/organization_meta_controller.php');
});

// users
$app->get('/api/users', function (Request $request, Response $response, array $args) {
    include('./api/controllers/user_controller.php');
});
$app->get('/api/users/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/user_controller.php');
});

// user icebreaker answers
$app->get('/api/user_icebreaker_answers', function (Request $request, Response $response, array $args) {
    include('./api/controllers/user_icebreaker_answers_controller.php');
});
$app->get('/api/user_icebreaker_answers/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/user_icebreaker_answers_controller.php');
});

// user interested 
$app->get('/api/user_interested', function (Request $request, Response $response, array $args) {
    include('./api/controllers/user_interested_controller.php');
});
$app->get('/api/user_interested/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/user_interested_controller.php');
});

// user meta 
$app->get('/api/user_meta', function (Request $request, Response $response, array $args) {
    include('./api/controllers/user_meta_controller.php');
});
$app->get('/api/user_meta/{id}', function (Request $request, Response $response, array $args) {
    include('./api/controllers/user_meta_controller.php');
});

$app->run();