<!DOCTYPE html>
<html>
<head>
    <title>Кинотека</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Кинотека</h1>
    
    <div class="btn-group">
        <a href="../main.php?tab=movies" class="btn">Фильмы</a>
        <a href="../main.php?tab=users" class="btn">Пользователи</a>

        <a href="../welcome.php" class="btn">Заставка</a>
    </div>
    
    <?php if ($tab == 'movies'): ?>
        <div class="mb-3">
    <a href="views/create_movie.php" class="btn">Добавить фильм</a>
        </div>
        <h2><br> ФИЛЬМЫ</h2>
        <table>
            <thead>
                <tr><th>Название</th><th>Год</th><th>Жанр</th><th>Рейтинг</th><th>Действия</th></tr>
            </thead>
            <tbody>
            <?php foreach($movies as $movie): ?>
                <tr>
                    <td><?php echo $movie['title']; ?></td>
                    <td><?php echo $movie['year']; ?></td>
                    <td><?php echo $movie['genre_name'] ?? '—'; ?></td>
                    <td><?php echo getAvgRating($pdo, $movie['id']); ?></td>
                    <td>
                        <a href="../controllers/movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-sm">Подробнее</a>
                        <a href="views/edit_movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-sm">Изменить</a>
                        <a href="../controllers/delete.php?type=movie&id=<?php echo $movie['id']; ?>" class="btn btn-sm" onclick="return confirm('Удалить?')">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <?php if ($tab == 'users'): ?>
        <div class="mb-3">
   <a href="views/create.view.php" class="btn">Добавить пользователя</a>
        </div>
        <h2><br>ПОЛЬЗОВАТЕЛИ</h2>
        <table class="table">
            <thead>
                <tr><th>ID</th><th>Имя</th><th>Email</th><th>Действия</th></tr>
            </thead>
            <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a href="../controllers/edit.php?id=<?php echo $user['id']; ?>" class="btn btn-sm">Изменить</a>
                        <a href="../controllers/delete.php?type=user&id=<?php echo $user['id']; ?>" class="btn btn-sm" onclick="return confirm('Удалить?')">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <?php if ($tab == 'reviews'): ?>
        <h2>ВСЕ ОТЗЫВЫ</h2>
        <?php if(empty($reviews)): ?>
            <p>Нет отзывов</p>
        <?php else: ?>
            <?php foreach($reviews as $review): ?>
                <div class="card">
                    <b><?php echo $review['user_name']; ?></b> 
                    на фильм <b><?php echo $review['movie_title']; ?></b> 
                    - Оценка: <?php echo $review['rating']; ?>/10
                    <p><?php echo nl2br($review['comment']); ?></p>
                    <small><?php echo $review['created_at']; ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>