<?php
include_once "../config/dbconnect.php";
include('functions.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];

$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = parse_url($requestUri, PHP_URL_PATH);
$requestUri = trim($requestUri, '/');

$pathParts = explode('/', $requestUri);


function getRequestBody() {
    return json_decode(file_get_contents('php://input'), true);
}

switch ($requestMethod) {
    case 'POST':
        switch ($pathParts[2]) {
            case 'insert':
                if ($pathParts[1] === 'review') {
                    $data = getRequestBody();
                    insertReview($data);
                } elseif ($pathParts[1] === 'book' && $pathParts[2] === 'request') {
                    $data = getRequestBody();
                    insertRequestedBook($data);
                } elseif ($pathParts[1] === 'rental' && $pathParts[2] === 'transaction') {
                    $data = getRequestBody();
                    insertRentalTransaction($data);
                }
                break;
            default:
                echo json_encode(["error" => "Invalid POST request"]);
                break;
        }
        break;

    case 'GET':
        switch ($pathParts[2]) {
            case 'history':
                if ($pathParts[1] === 'rental') {
                    $data = getRequestBody();
                    if (isset($data['id'])) {
                        getHistoryById($data['id']);
                    } else {
                        echo json_encode(["error" => "ID is missing in the body"]);
                    }
                }
                break;
            case 'review':
                if ($pathParts[3] === 'all') {
                    getAllReviews();
                }
                break;
            default:
                echo json_encode(["error" => "Invalid GET request"]);
                break;
        }
        break;

    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}
?>
