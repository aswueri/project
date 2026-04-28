<?php
require_once '../model/models.php';

$movie_id = $_POST['movie_id'];
$new_actor = trim($_POST['actor']);

if (!empty($new_actor)) {
    $pdo = connectDB();
    $stmt = $pdo->prepare("SELECT actors FROM movies WHERE id = ?");
    $stmt->execute([$movie_id]);
    $current = $stmt->fetch();
    
    $actors = $current['actors'] ? explode(',', $current['actors']) : [];
    $actors[] = $new_actor;
    $actors_str = implode(',', $actors);
    
    $stmt = $pdo->prepare("UPDATE movies SET actors = ? WHERE id = ?");
    $stmt->execute([$actors_str, $movie_id]);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();