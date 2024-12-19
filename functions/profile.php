<?php
session_start();
include '../config.php';

$userId = $_SESSION['user_login'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$profile_image = null;

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $newFileName = time() . '_' . $_FILES['profile_image']['name'];
    $profile_image = '../uploads/profile/' . $newFileName;
    move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image);
}

if ($firstname && $lastname && $email) {
    try {
        $stmt = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?" . ($profile_image ? ", profile_image = ?" : "") . " WHERE id = ?");
        $params = [$firstname, $lastname, $email];
        if ($profile_image) $params[] = $profile_image;
        $params[] = $userId;
        $stmt->execute($params);

        echo json_encode('Profile updated successfully!');
    } catch (PDOException $e) {
        echo json_encode($e->getMessage());
    }
} else {
    echo json_encode('Please fill in all fields.');
}
?>
