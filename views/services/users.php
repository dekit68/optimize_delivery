<?php
    require 'config.php';
    $foods = gwt('food', 'food_type', 'name', 'food_type_name', 'type_id', 'id',  $pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Menu</h1>
        
        <div class="row">
            <?php foreach ($foods as $food): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= $food['food_img']; ?>" class="card-img-top" alt="<?= $food['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $food['name']; ?></h5>
                            <p class="card-text"><?= $food['food_type_name']; ?></p>
                            <p class="card-text"><strong>ราคา: <?= number_format($food['price'], 2); ?> บาท</strong></p>
                            <a href="?food_id=<?= $food['id']; ?>" class="btn btn-primary">เลือก</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>