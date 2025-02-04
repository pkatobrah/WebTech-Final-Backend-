<?php
require_once 'db/config.php';
function cors() {
    
    
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400'); 
    }
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }
    
    echo "You have CORS!";
}
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {

    case 'DELETE':
        $id = $_GET['id'];
        
        $stmt = $pdo->prepare('DELETE FROM books WHERE book_id=?');
        $stmt->execute([$id]);
        
        echo json_encode(['message' => 'Book deleted successfully']);
        break;
        default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;

}
?>
