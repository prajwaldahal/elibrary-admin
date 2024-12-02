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
            case 'review':
                if ($pathParts[3] === 'insert') {
                    $data = getRequestBody();
                    insertReview($data);
                }
                break;
            case 'book':
                if ($pathParts[3] === 'request') {
                    $data = getRequestBody();
                    insertRequestedBook($data);
                }
                break;
            case 'rental':
                if ($pathParts[3] === 'transaction') {
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
            case 'rental':
                if ($pathParts[3] === 'history' && isset($_GET['user_id'])) {
                    getHistoryById($_GET['user_id']);
                } else {
                    echo json_encode(["error" => "User ID (user_id) is missing in query parameters"]);
                }
                break;
            case 'review':
                if ($pathParts[3] === 'all') {
                    getAllReviews();
                }
                break;
            case 'books':
                if ($pathParts[3] === 'search') {
                    $filterOptions = [
                        'keyword' => isset($_GET['query']) ? $_GET['query'] : null,
                        'category_id' => isset($_GET['categoryId']) ? $_GET['categoryId'] : null,
                        'min_price' => isset($_GET['minPrice']) ? $_GET['minPrice'] : null,
                        'max_price' => isset($_GET['maxPrice']) ? $_GET['maxPrice'] : null,
                        'min_rating' => isset($_GET['minRating']) ? $_GET['minRating'] : null
                    ];

                    searchBooks($filterOptions);
                } else {
                    echo json_encode(["error" => "Invalid search request, please check query parameters"]);
                }
                break;
            case 'categories':
                getAllCategories();
                break;
            case 'users':
                if (isset($_GET['user_id'])) {
                    getUserById($_GET['user_id']);
                } else {
                    echo json_encode(["error" => "User ID (user_id) is missing in query parameters"]);
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
