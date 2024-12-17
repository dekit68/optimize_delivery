<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Dashboard Page</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                <?php
                if (isset($_SESSION['user_login'])) {
                    $userId = $_SESSION['user_login'];
                    $user = getUserById($userId, $pdo); 
                    if ($user) {
                        echo "User ID: " . $user['id'] . "<br>";
                        echo "Name: " . $user['firstname'] . " " . $user['lastname'] . "<br>";
                        echo "Email: " . $user['email'] . "<br>";
                    } else {
                        echo "User not found.";
                    }
                }
                ?>
            </p>
        </div>
    </div>
</body>

</html>