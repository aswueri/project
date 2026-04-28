<?php
require_once '../model/models.php';
$pdo = connectDB();
$review = selectReviewById($pdo, [':id' => $_GET['id']]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':id' => $_POST['id'],
        ':rating' => $_POST['rating'],
        ':comment' => $_POST['comment']
    ];
    updateReview($pdo, $data);
    header('Location: ../controllers/movie.php?id=' . $_POST['movie_id']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редактировать отзыв</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Редактировать отзыв</h1>
    <h4>Фильм: <?php echo $review['movie_title']; ?></h4>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $review['id']; ?>">
        <input type="hidden" name="movie_id" value="<?php echo $review['movie_id']; ?>">
        
        <input type="text" value="<?php echo $review['user_name']; ?>" disabled>
        
        <select name="rating" required>
            <?php for($i=1;$i<=10;$i++): ?>
                <option value="<?php echo $i; ?>" <?php echo ($review['rating'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?>/10</option>
            <?php endfor; ?>
        </select>
        
        <textarea name="comment" rows="4" required><?php echo $review['comment']; ?></textarea>
        
        <button type="submit">Сохранить</button>
        <a href="../controllers/movie.php?id=<?php echo $review['movie_id']; ?>" class="btn">Назад</a>
    </form>
</div>
</body>
</html>