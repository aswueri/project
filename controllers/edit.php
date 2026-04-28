<?php
$id = [":id" => $_GET["id"]];
require_once '../model/models.php';
$pdo = connectDB();
$user = selectUserById($pdo, $id);
include '../views/edit.view.php';
?>