<?php

    $usern = $_POST['username'];

    if ($usern == 'xxx') {
        echo json_encode(array("status" => "success", "msg" => "Login successful!"));
    }

?>