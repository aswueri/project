<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Кинотека</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        
        .animated-title {
            animation: fadeIn 1s ease-out;
        }
        
        .animated-text {
            animation: fadeIn 1.2s ease-out;
        }
        
        .animated-buttons {
            animation: fadeIn 1.5s ease-out;
        }
        
        .btn-animated {
            transition: all 0.3s ease;
        }
        
        .btn-animated:hover {
            transform: scale(1.05);
            background: #cc0000;
        }
        
        .emoji-blink {
            animation: pulse 2s infinite;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="container">
    <div style="text-align: center; margin-top: 100px;">
        <div class="animated-title">
        </div>
        <div class="animated-title">
            <h1 style="font-size: 60px;">Кинотека</h1>
        </div>
        <div class="animated-text">
            <p style="font-size: 20px; margin: 20px 0;">Твоя личная коллекция фильмов</p>
        </div>
        <div class="animated-text">
            <p style="margin-bottom: 40px;">Добавляй фильмы, ставь оценки, пиши отзывы</p>
        </div>
        
        <div class="animated-buttons">
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                <a href="main.php?tab=movies" class="btn btn-animated" style="font-size: 18px; padding: 12px 30px;">Фильмы</a>
                <a href="main.php?tab=users" class="btn btn-animated" style="font-size: 18px; padding: 12px 30px;">Пользователи</a>
                <a href="main.php?tab=reviews" class="btn btn-animated" style="font-size: 18px; padding: 12px 30px;">Отзывы</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>