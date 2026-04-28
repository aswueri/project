<?php
require_once '../model/models.php';
$pdo = connectDB();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $movie['title']; ?> — Кинотека</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .movie-poster {
            float: right;
            width: 300px;
            background: #141414;
            border: 1px solid #7a2e2e;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-left: 20px;
        }
        .movie-poster img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .movie-info {
            margin-bottom: 30px;
        }
        .rating-big {
            font-size: 48px;
            font-weight: bold;
            color: #b84c4c;
        }
        .rating-label {
            color: #aaa;
        }
        .movie-description {
            line-height: 1.6;
            margin: 20px 0;
        }
        hr {
            border-color: #7a2e2e;
            margin: 20px 0;
        }
        .cast-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 10px 0;
        }
        .cast-item {
            background: #0a0a0a;
            padding: 5px 12px;
            border-radius: 20px;
            border: 1px solid #7a2e2e;
        }
        .add-role-btn {
            background: none;
            border: none;
            color: #7a2e2e;
            font-size: 12px;
            cursor: pointer;
            padding: 2px 8px;
            margin-left: 10px;
        }
        .add-role-btn:hover {
            color: #b84c4c;
            background: none;
        }
        .role-form {
            display: none;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .role-form input {
            width: auto;
            display: inline-block;
            margin-right: 10px;
        }
        .role-form button {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <a href="../main.php?tab=movies" class="btn">Назад к фильмам</a>
        <a href="../welcome.php" class="btn">Главная</a>
    </div>
    
    <div class="movie-info">
        <div class="movie-poster">
            <?php if(!empty($movie['poster'])): ?>
                <img src="<?php echo $movie['poster']; ?>" alt="<?php echo $movie['title']; ?>">
            <?php else: ?>
                <div style="font-size: 80px;">🎬</div>
            <?php endif; ?>
            <div class="rating-big"><?php echo getAvgRating($pdo, $movie['id']); ?></div>
            <div class="rating-label">рейтинг</div>
            <hr>
            <div><strong>Год:</strong> <?php echo $movie['year']; ?></div>
            <div><strong>Жанр:</strong> <?php echo $movie['genre_name'] ?? 'не указан'; ?></div>
        </div>
        
        <h1 style="font-size: 48px; margin-bottom: 10px;"><?php echo $movie['title']; ?></h1>
        <h3 style="color: #888; margin-bottom: 20px;"><?php echo $movie['year']; ?></h3>
        
        <div class="movie-description">
            <h2>Описание</h2>
            <p><?php echo nl2br($movie['description'] ?: 'Описание отсутствует'); ?></p>
        </div>
        
        <div class="movie-description">
            <h2>В главных ролях</h2>
            <div class="cast-list">
                <?php
                $actors = explode(',', $movie['actors'] ?? '');
                foreach($actors as $actor):
                    $actor = trim($actor);
                    if(!empty($actor)):
                ?>
                    <div class="cast-item"><?php echo $actor; ?></div>
                <?php 
                    endif;
                endforeach; 
                ?>
                <?php if(empty($movie['actors'])): ?>
                    <p style="color: #888;">Информация о ролях отсутствует</p>
                <?php endif; ?>
            </div>
            <button class="add-role-btn" onclick="toggleRoleForm()">+ добавить роль</button>
            
            <div id="roleForm" class="role-form">
                <form action="../controllers/add_actor.php" method="post">
                    <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">
                    <input type="text" name="actor" placeholder="Имя актёра" required>
                    <button type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
    
    <div style="margin: 30px 0;">
        <a href="create_review.php?movie_id=<?php echo $movie['id']; ?>" class="btn" style="background: #7a2e2e; font-size: 18px; padding: 12px 30px;">Написать отзыв</a>
    </div>
    
    <h2>Отзывы зрителей</h2>
    
    <?php if(empty($reviews)): ?>
        <div class="card" style="text-align: center; padding: 40px;">
            <p style="font-size: 18px;">Пока нет отзывов</p>
            <p>Будьте первым, кто оценит этот фильм</p>
        </div>
    <?php else: ?>
        <?php foreach($reviews as $review): ?>
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <b style="font-size: 18px;"><?php echo $review['user_name']; ?></b>
                        <span style="color: #b84c4c; margin-left: 15px;">⭐ <?php echo $review['rating']; ?>/10</span>
                    </div>
                    <small><?php echo $review['created_at']; ?></small>
                </div>
                <p style="margin-top: 15px; line-height: 1.5;"><?php echo nl2br($review['comment']); ?></p>
                <div style="margin-top: 10px;">
                    <a href="../controllers/edit_review.php?id=<?php echo $review['id']; ?>&movie_id=<?php echo $movie['id']; ?>" class="btn btn-sm">Изменить</a>
                    <a href="../controllers/delete_review.php?id=<?php echo $review['id']; ?>&movie_id=<?php echo $movie['id']; ?>" class="btn btn-sm" onclick="return confirm('Удалить отзыв?')">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
function toggleRoleForm() {
    var form = document.getElementById('roleForm');
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}
</script>
</body>
</html>