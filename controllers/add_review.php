<?php
require_once '../model/models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        ':user_id' => $_POST['user_id'],
        ':movie_id' => $_POST['movie_id'],
        ':rating' => $_POST['rating'],
        ':comment' => $_POST['comment']
    ];

    $pdo = connectDB();
    $sql = "INSERT INTO reviews (user_id, movie_id, rating, comment) VALUES (:user_id, :movie_id, :rating, :comment)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    header('Location: movie.php?id=' . $_POST['movie_id']);
    exit();
} else {
    header('Location: ../main.php');
    exit();
}