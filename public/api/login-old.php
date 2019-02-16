<?php
//die(' you hit the login file....');
require_once('./dbconnect_connectAPP.php');

//die("so far so good..million miles to go...");
//require_once( BASE_DIR . '/vendor/miltonian/custom/data/DBClasses.php' );
/*
 $query="select * from users order by id";
    die($query);
    $result= $mysqli->query($query);
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    if(isset($data)) {
        header('content-type: application/json');
        echo json_encode($data);
    }

*/ 


 
$query = 'SELECT * FROM users WHERE email='.$_POST['username'].'';
//echo($query);
$result= $mysqli->query($query);
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
if(isset($data)) {
    header('content-type: application/json');
        echo json_encode($data);
    //return $data;
    //header('content-type: application/json');
    //echo json_encode($data);
}else{
    echo("not regular user check if organization...");
}

//$values = [$username];
//$type = 'select';
//$searchresult = DBClasses::querySQL( $query, $values, $type );
$login_type = "user";



die("so far so good..million miles to go...");

if( $searchresult[0] == 0 ) {

	$query = 'SELECT * FROM organizations WHERE email=?';
	$values = [$username];
	$type = 'select';
	$searchresult = DBClasses::querySQL( $query, $values, $type );

	if( $searchresult[0] == 1 ) {
		$login_type = "organization";
	}
}

if( $login_type == "organization" ) {
	$query = 'SELECT * FROM organizations WHERE email=? AND password=?';
} else {
	$query = 'SELECT * FROM users WHERE email=? AND password=?';
}
////die("echo A");
//die( $query ." | " . $username. " | " . $password);
$result = DBClasses::checkLogin( $query, $username, $password );
//die("echo 1");
if( $result[0] == 0 ) {
	//die("echo 3");
	exit( json_encode( $result ) );
}
//die("echo 2");
if( $login_type == "organization" ) {
	$query = 'SELECT * FROM organizations WHERE email=?';
} else {
	$query = 'SELECT * FROM users WHERE email=?';
}
$values = [$username];
$type = 'select';
$result = DBClasses::querySQL( $query, $values, $type );

//echo("result: ".$result);
if( $result[0] == 1 ) {
	//die("spot two");
	if( $login_type == "organization" ) {
		$organization_id = $result[1][0]['id'];
		$token = bin2hex(openssl_random_pseudo_bytes(32));
		$login_token_time = time();
		DBClasses::querySQL('UPDATE organizations SET login_token=?, login_token_time=? WHERE id=?', [$token, $login_token_time, $organization_id], 'update');
		$result[1][0]['login_token'] = $token;
		$result[1][0]['login_token_time'] = $login_token_time;
	} else {
		$user_id = $result[1][0]['id'];
		$token = bin2hex(openssl_random_pseudo_bytes(32));
		$login_token_time = time();
		DBClasses::querySQL('UPDATE users SET login_token=?, login_token_time=? WHERE id=?', [$token, $login_token_time, $user_id], 'update');
		$result[1][0]['login_token'] = $token;
		$result[1][0]['login_token_time'] = $login_token_time;
	}

	$result = [1, $result[1][0], $login_type];
}else{
	//die("spot one");
}

exit( json_encode( $result ) );
