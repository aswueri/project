<?php
require_once '../model/models.php';
$pdo = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':name' => $_POST['name'],
        ':email' => $_POST['email']
    ];
    insertUser($pdo, $data);
    header('Location: ../main.php?tab=users');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Добавить пользователя</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Добавить пользователя</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Имя" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Сохранить</button>
        <a href="../main.php?tab=users" class="btn">Назад</a>
    </form>
</div>
</body>
</html>