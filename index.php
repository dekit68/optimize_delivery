<?php 

include 'module/function.php';

// ดึง path จาก URL และตัด query string ออก (ถ้ามี)
// $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// จัดการกับเส้นทางที่ได้รับจาก REQUEST_URI
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])); // เปลี่ยน \ เป็น / เพื่อรองรับ Windows
$request = str_replace($basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); // ตัด basePath ออก

// ตรวจสอบเส้นทาง
switch ($request) {
    case '/':
        require __DIR__ . '/view/home.php';
        break;
    case '/cart':
        require __DIR__ . '/view/cart.php';
        break;
    case '/login':
        require __DIR__ . '/view/login.php';
        break;
    case '/verify':
        require __DIR__ . '/module/login_db.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/view/404.php';
        break;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/sweetalert2/sweetalert2.min.js"></script>
    <script src="jquery-3.7.1.min.js"></script>
</head>