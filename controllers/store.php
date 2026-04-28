<?php
require_once '../model/models.php';
if (isset($_POST['name']) && isset($_POST['email'])) {
    $data = [
        ':name' => $_POST['name'],
        ':email' => $_POST['email']
    ];
    insertUser(connectDB(), $data);
}

header('Location: ../main.php');