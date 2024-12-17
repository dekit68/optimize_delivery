<?php

route('/fetch_data', function(){
    require 'config.php';
    echo json_encode($pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC));
});

route('/update_user', function(){
    require 'config.php';
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $role = $data['role'];
    $email = $data['email'];
    $firstname = $data['firstname'];
    if ($id && $role && $email && $firstname) {
        try {
            $stmt = $pdo->prepare("UPDATE users SET role = ?, email = ?, firstname = ? WHERE id = ?");
            $stmt->execute([$role, $email, $firstname, $id]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ข้อมูลไม่ครบถ้วน']);
    }
});

route('/delete_user', function(){
    require 'config.php';

    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!empty($data['id'])) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $data['id']);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
});

?>