<?php

require_once("./config.php");
require_once("./MySQLHandler.php");




$method = $_SERVER['REQUEST_METHOD'];
var_dump($method);


//parse url http://localhost/web_service_labs/day2/index.php/items/5
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
//  var_dump($parts);


//resources
$resource = isset($parts[4]) ? $parts[4] : null;
//   var_dump($resource);

//resource id
$resourceid = isset($parts[5]) ? $parts[5] : null;
// var_dump($resourceid);

//data 



$myhandler = new MySQLHandler("products");

$myhandler->connect();


switch ($method) {
    case 'GET':

///**************************switch on resource in case of get ***************************************/
        switch ($resource) {
            case 'items':

                  // if no id passed
                if ($resourceid == null) {
                   
                    $data = $myhandler->get_data();

                    header('Content-Type: application/json');
                    echo json_encode($data);
                  // if id passed and between {0-10}
                } elseif ($resourceid <= 10 && $resourceid > 0) {

                    $data = $myhandler->get_record_by_id($resourceid);


                    header('Content-Type: application/json');

                    echo json_encode($data);
                     //if wrong id passed
                } else {
                    echo json_encode(['error' => 'resource doesnot exist']);

                    http_response_code(404);
                }

                break;
                 //if switch on different resource
            default:
                echo json_encode(['error' => 'resource doesnot exist']);

                http_response_code(404);
                break;
///**************************end switch on resource in case of get*************************************** **/

        }

        break;
   //***********************************in case delete method********************************* */
    case 'DELETE':
        $check = $myhandler->delete($resourceid);
        echo json_encode($check);
        // if delete success
        if ($check == true) {
            $myhandler->connect();
            $data = $myhandler->get_data();
            header('Content-Type: application/json');
            echo json_encode($data);
                // if delete failed
        } else {
            echo json_encode(['error' => 'resource doesnot exist']);

            http_response_code(404);
        }
        break;
        
/***********************************in case update method********************************* */
    case 'PUT':
        $xx = file_get_contents("php://input");
        var_dump($xx);
        $myhandler->connect();
        $myhandler->update(json_decode($xx), $resourceid);
        break;

/*****************************************in case any other request********************************** */
    default:
        # code...
        echo json_encode(['error' => 'method not allowed']);
        http_response_code(405);
        break;
}