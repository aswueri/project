<?php
require_once '../model/models.php';
$pdo = connectDB();
$movie = selectMovieById($pdo, [':id' => $_GET['id']]);
$reviews = selectReviewsByMovieId($pdo, [':movie_id' => $_GET['id']]);
$users = selectAllUsers($pdo);

include '../views/movie.view.php';
?>