<?php
require_once '../src/Controllers/ProductController.php';

$controller = new ProductController();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestUri) {
    case '/products':
        if ($requestMethod === 'GET') {
            $controller->list();
        } elseif ($requestMethod === 'POST') {
            $controller->add();
        }
        break;

    case '/products/remove':
        if ($requestMethod === 'POST') {
            $controller->remove();
        }
        break;

    default:
        http_response_code(404);
        echo '404 Not Found';
        break;
}
