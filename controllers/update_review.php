<?php
require_once '../model/models.php';
$data = [
    ':id' => $_POST['id'],
    ':rating' => $_POST['rating'],
    ':comment' => $_POST['comment']
];

updateReview(connectDB(), $data);

header('Location: movie.php?id=' . $_POST['movie_id']);