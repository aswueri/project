<?php
require_once '../model/models.php';
$pdo = connectDB();
$user = selectUserById($pdo, [':id' => $_GET['id']]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':id' => $_POST['id'],
        ':name' => $_POST['name'],
        ':email' => $_POST['email']
    ];
    updateUser($pdo, $data);
    header('Location: ../main.php?tab=users');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редактировать пользователя</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Редактировать пользователя</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <button type="submit">Сохранить</button>
        <a href="../main.php?tab=users" class="btn">Назад</a>
    </form>
</div>
</body>
</html>