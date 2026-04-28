<?php
require_once '../model/models.php';
$pdo = connectDB();
$genres = selectAllGenres($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':title' => $_POST['title'],
        ':year' => $_POST['year'] ?? null,
        ':description' => $_POST['description'] ?? null,
        ':genre_id' => !empty($_POST['genre_id']) ? $_POST['genre_id'] : null,
        ':actors' => $_POST['actors'] ?? null,
        ':poster' => $_POST['poster'] ?? null
    ];
    insertMovie($pdo, $data);
    header('Location: ../main.php?tab=movies');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Добавить фильм</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Добавить фильм</h1>
    <form method="post">
        <input type="text" name="title" placeholder="Название" required>
        <input type="text" name="year" placeholder="Год">
        <select name="genre_id">
            <option value="">Жанр</option>
            <?php foreach($genres as $genre): ?>
                <option value="<?php echo $genre['id']; ?>"><?php echo $genre['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <textarea name="description" rows="4" placeholder="Описание"></textarea>
        <textarea name="actors" rows="3" placeholder="В главных ролях (через запятую)"></textarea>
        <input type="text" name="poster" placeholder="Ссылка на постер (URL)">
        <button type="submit">Сохранить</button>
        <a href="../main.php?tab=movies" class="btn">Назад</a>
    </form>
</div>
</body>
</html>