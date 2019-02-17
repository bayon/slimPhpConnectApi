<?php
//die(' you hit the api index  on localhost:8888......');
error_reporting(E_ALL);
 ini_set('display_errors','On');
// define( 'BASE_DIR', realpath( dirname( __FILE__ ) . '/../' ) );
define( 'BASE_DIR', realpath( dirname( __FILE__ ) . '/' ) );
//die('BASE_DIR:'.BASE_DIR);
global $router, $match;
//echo("echo 1");
require_once BASE_DIR . '/vendor/miltonian/custom/data/Load.php';
Load::setUp();
//echo("echo 2");
$router = new AltoRouter();
//echo("echo 3");
$router->map( 'POST', '/edit_view.php', function() {
	global $router, $match;
	require 'vendor/miltonian/reusables/functions/edit_view.php';
}, "");
//echo("echo 3.1");
$router->map( 'POST', '/functions/login', function() {
	global $router, $match;
	require 'vendor/miltonian/reusables/functions/login.php';
}, "");
//echo("echo 3.2");
$router->map( 'GET', '/makereusablezip', function() {
	global $router, $match;
	require 'vendor/miltonian/custom/functions/makereusablezip.php';
}, "");
//echo("echo 3.3");
$router->map( 'POST', '/custom/edit_view', function() {
	global $router, $match;
	require 'vendor/miltonian/custom/functions/edit_view.php';
}, "");
//echo("echo 3.4");
$router->map( 'POST', '/functions/createlogin', function() {
	global $router, $match;
	require 'vendor/miltonian/custom/functions/createlogin.php';
}, "");
//echo("echo 3.5");
$router->map( 'GET', '/login', function() {
	global $router, $match;
	require 'views/login.php';
}, "");
//echo("echo 3.6");
$router->map( 'GET', '/logout', function() {
	global $router, $match;
	require 'views/logout.php';
}, "");
//echo("echo 3.7");
$router->map( 'GET', '/', function() {
	global $router, $match;
	require 'views/home.php';
}, "");
//echo("echo 3.8");
$router->map( 'POST', '/api/register', function() {
	global $router, $match;
	require 'api/register.php';
}, "");
//echo("echo 3.9");
$router->map( 'POST', '/api/login', function() {
	global $router, $match;
	//echo("echo 4 in api/login");
	require 'api/login.php';
	//echo("echo 5 got the login file or no?");

}, "");
//echo("<pre>");print_r($_POST); //echo("</pre>");
$router->map( 'POST', '/api/[*:trailing]', function() {
	global $router, $match;
	Auth::authorize($_POST);
	require 'api/' . $match['params']['trailing'] . '.php';
}, "");
//echo("echo 6");
$router->map( 'GET', '/api/[*:trailing]', function() {
	global $router, $match;
	require 'api/' . $match['params']['trailing'] . '.php';
}, "");
//echo("echo 7");
$router->map( 'GET', '/[*:trailing]', function() {
	global $router, $match;
	require 'views/' . $match['params']['trailing'] . '.php';
}, "");
//echo("echo 8");
$match = $router->match();
//echo("</br>match<pre>");print_r($match);//echo("</pre>");
// call closure or throw 404 status
if( $match && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
