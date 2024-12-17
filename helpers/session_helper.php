<?php
function CS() {
    if (!isset($_SESSION['role'])) {
        header("Location: ../index.php");
        exit();
    }
}

function RBR($role) {
    switch ($role) {
        case 'admin':
            header("Location: admin/dashboard.php");
            break;
        case 'manager':
            header("Location: manager/dashboard.php");
            break;
        case 'user':
            header("Location: user/dashboard.php");
            break;
        case 'delivery':
            header("Location: delivery/dashboard.php");
            break;
        default:
            header("Location: index.php");
            break;
    }
}
?>