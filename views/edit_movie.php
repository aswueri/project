<?php
require_once '../model/models.php';
$pdo = connectDB();
$genres = selectAllGenres($pdo);
$movie = selectMovieById($pdo, [':id' => $_GET['id']]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':id' => $_POST['id'],
        ':title' => $_POST['title'],
        ':year' => $_POST['year'],
        ':description' => $_POST['description'],
        ':genre_id' => $_POST['genre_id'] ?: null,
        ':actors' => $_POST['actors'] ?? null,
        ':poster' => $_POST['poster'] ?? null
    ];
    updateMovie($pdo, $data);
    header('Location: ../main.php?tab=movies');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редактировать фильм</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Редактировать фильм</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">
        <input type="text" name="title" value="<?php echo $movie['title']; ?>" required>
        <input type="text" name="year" value="<?php echo $movie['year']; ?>">
        <select name="genre_id">
            <option value="">Жанр</option>
            <?php foreach($genres as $genre): ?>
                <option value="<?php echo $genre['id']; ?>" <?php echo ($genre['id'] == $movie['genre_id']) ? 'selected' : ''; ?>>
                    <?php echo $genre['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <textarea name="description" rows="4"><?php echo $movie['description']; ?></textarea>
        <textarea name="actors" rows="3" placeholder="В главных ролях (через запятую)"><?php echo $movie['actors']; ?></textarea>
        <input type="text" name="poster" value="<?php echo $movie['poster']; ?>" placeholder="Ссылка на постер (URL)">
        <button type="submit">Сохранить</button>
        <a href="../main.php?tab=movies" class="btn">Назад</a>
    </form>
</div>
</body>
</html>