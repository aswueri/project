<?php
require_once 'model/models.php';
$pdo = connectDB();

$tab = $_GET['tab'] ?? 'movies';

if ($tab == 'users') {
    $users = selectAllUsers($pdo);
} elseif ($tab == 'reviews') {
    $reviews = $pdo->query("SELECT r.*, u.name as user_name, m.title as movie_title FROM reviews r JOIN users u ON r.user_id = u.id JOIN movies m ON r.movie_id = m.id ORDER BY r.created_at DESC")->fetchAll();
} else {
    $movies = selectAllMovies($pdo);
}

include 'views/index.show.php';
?>