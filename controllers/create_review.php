<?php
require_once '../model/models.php';
$pdo = connectDB();
$users = selectAllUsers($pdo);
$movie_id = $_GET['movie_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Добавить отзыв</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Добавить отзыв</h1>
    <form action="../controllers/add_review.php" method="post">
        <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
        
        <select name="user_id" required>
            <option value="">Пользователь</option>
            <?php foreach($users as $user): ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
            <?php endforeach; ?>
        </select>
        
        <select name="rating" required>
            <option value="">Оценка</option>
            <?php for($i=1;$i<=10;$i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?>/10</option>
            <?php endfor; ?>
        </select>
        
        <textarea name="comment" rows="4" placeholder="Текст отзыва" required></textarea>
        
        <button type="submit">Отправить</button>
        <a href="../controllers/movie.php?id=<?php echo $movie_id; ?>" class="btn">Назад</a>
    </form>
</div>
</body>
</html>