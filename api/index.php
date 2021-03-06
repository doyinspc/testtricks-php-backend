<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PATCH, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include '../connect/common.php';
include '../connect/connect.php';
$op = new Db;
//GET REQUEST

if($_SERVER['REQUEST_METHOD'] === 'GET')
{
	$queries = array();
	parse_str($_SERVER['QUERY_STRING'], $queries);
	$query = in_array('data', $queries) ? $queries['data'] ? NULL;
	$cat = in_array('cat', $queries) ? $queries['cat'] ? NULL;
	$table = in_array('table', $queries) ? $queries['table'] ? NULL;
	$token = in_array('token', $queries) ? $queries['token'] ? NULL;
	$data = array();

	if($cat == 'all')
	{
		$data = $op->select($table, NULL, $query);
	}

	if($cat == 'cat')
	{
		$data = $op->select($table, NULL, $query);
	}

	if($cat == 'one')
	{
		$data = $op->selectOne($table, NULL, $query);
	}

	if($cat == 'ins')
	{
		$data = $op->selectINS($table, NULL, $query);
	}

	if($cat == 'count')
	{
		$data = $op->selectCountQuestion($table, NULL, $query['topicID']);
	}

	if($cat == 'countins')
	{
		$data = $op->selectQuestion($query['topicID']);
	}
	
	if(is_array($data) && count($data) > 0 )
	{
		// set response code - 200 OK
    	http_response_code(200);
		echo json_encode($data);
	}
	else
	{
	    // set response code - 404 Not found
	    http_response_code(404);
	    echo json_encode(array("message" => "No found."));
	}	
}



?>